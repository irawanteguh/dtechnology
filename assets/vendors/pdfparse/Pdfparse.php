<?php

class Pdfparse
{
    protected $tmpHash;
    protected $parsedSource = [];
    protected $tmpDir;

    public function __construct($pdfFile)
    {
        libxml_use_internal_errors(true);

        $this->tmpHash = md5(uniqid('', true));

        $this->_parse($pdfFile);
    }

    /*
    ==================================================
    FIND TEXT
    ==================================================
    */
    public function findText($textFind, $caseSensitive = false)
    {
        if (!is_array($textFind)) {
            $textFind = [$textFind];
        }

        $result = [
            'page'    => [],
            'content' => []
        ];

        foreach ($this->parsedSource as $pageIndex => $pageContent) {

            $html = new DOMDocument();

            @$html->loadHTML($pageContent);

            $pageNum = $pageIndex + 1;

            /*
            ==================================================
            PAGE SIZE
            ==================================================
            */
            $background = $html->getElementById('background');

            if ($background) {

                $result['page']['page' . $pageNum] = [
                    'width'  => $background->getAttribute('width'),
                    'height' => $background->getAttribute('height')
                ];
            }

            /*
            ==================================================
            LOOP TEXT
            ==================================================
            */
            foreach ($textFind as $find) {

                foreach ($html->getElementsByTagName('div') as $div) {

                    $text = trim($div->textContent);

                    if ($text === '') {
                        continue;
                    }

                    $haystack = $caseSensitive ? $text : strtolower($text);
                    $needle   = $caseSensitive ? $find : strtolower($find);

                    /*
                    ==================================================
                    MATCH TEXT
                    ==================================================
                    */
                    if (strpos($haystack, $needle) !== false) {

                        $style = $div->getAttribute('style');

                        preg_match('/left\:([0-9\.]+)px/i', $style, $left);
                        preg_match('/top\:([0-9\.]+)px/i', $style, $top);

                        $x = isset($left[1]) ? floatval($left[1]) : 0;
                        $y = isset($top[1]) ? floatval($top[1]) : 0;

                        if (!isset($result['content'][$find])) {
                            $result['content'][$find] = [];
                        }

                        $result['content'][$find][] = [
                            'text' => $text,
                            'x'    => $x,
                            'y'    => $y,
                            'page' => $pageNum
                        ];
                    }
                }
            }
        }

        return $result;
    }

    /*
    ==================================================
    CLEANUP
    ==================================================
    */
    public function cleanup()
    {
        if (!empty($this->tmpDir) && is_dir($this->tmpDir)) {
            $this->_delDirRecursive($this->tmpDir);
        }
    }

    /*
    ==================================================
    PARSE PDF
    ==================================================
    */
    private function _parse($pdfFile)
    {
        if (!file_exists($pdfFile)) {
            throw new Exception("PDF file not found: " . $pdfFile);
        }

        if ($this->_getExtension($pdfFile) !== 'pdf') {
            throw new Exception("File is not PDF");
        }

        $outputDir = $this->_safePath(
            $this->_tempDir() . '/' . basename($pdfFile)
        );

        /*
        ==================================================
        CONVERT PDF TO HTML
        ==================================================
        */
        $this->_convertToHtml($pdfFile, $outputDir);

        $indexHtml = $this->_safePath($outputDir . '/index.html');

        if (!file_exists($indexHtml)) {
            throw new Exception("Failed generate index.html");
        }

        /*
        ==================================================
        GET MAX PAGE
        ==================================================
        */
        $maxPage = $this->_maxPage($indexHtml);

        for ($page = 1; $page <= $maxPage; $page++) {

            $pageFile = $this->_safePath(
                $outputDir . '/page' . $page . '.html'
            );

            $this->parsedSource[] = $this->_readFile($pageFile);
        }
    }

    /*
    ==================================================
    CONVERT PDF TO HTML
    ==================================================
    */
    private function _convertToHtml($input, $output)
    {
        /*
        ==================================================
        VALIDASI INPUT
        ==================================================
        */
        if (!file_exists($input)) {
            throw new Exception("Input PDF not found");
        }

        $binary = $this->_binPath();

        if (!file_exists($binary)) {
            throw new Exception("Binary not found: " . $binary);
        }

        /*
        ==================================================
        LINUX / MAC EXECUTABLE
        ==================================================
        */
        if ($this->_platform() !== 'win') {
            @chmod($binary, 0755);
        }

        /*
        ==================================================
        BUILD COMMAND
        ==================================================
        */
        $command =
            escapeshellarg($binary) .
            ' -q ' .
            escapeshellarg($input) .
            ' ' .
            escapeshellarg($output);

        /*
        ==================================================
        PROC_OPEN
        ==================================================
        */
        if (function_exists('proc_open')) {

            $descriptor = [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w']
            ];

            $process = proc_open(
                $command,
                $descriptor,
                $pipes
            );

            if (!is_resource($process)) {
                throw new Exception("Cannot start process");
            }

            fclose($pipes[0]);

            $stdout = stream_get_contents($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);

            $status = proc_close($process);

            if ($status !== 0) {

                throw new Exception(
                    "Convert failed.\n" .
                    trim($stderr)
                );
            }

        /*
        ==================================================
        EXEC
        ==================================================
        */
        } elseif (function_exists('exec')) {

            exec($command . ' 2>&1', $outputExec, $status);

            if ($status !== 0) {

                throw new Exception(
                    "Convert failed.\n" .
                    implode("\n", $outputExec)
                );
            }

        /*
        ==================================================
        SHELL_EXEC
        ==================================================
        */
        } elseif (function_exists('shell_exec')) {

            $result = shell_exec($command . ' 2>&1');

            if ($result === null) {
                throw new Exception("Convert failed");
            }

        } else {

            throw new Exception(
                "proc_open, exec, shell_exec disabled"
            );
        }

        /*
        ==================================================
        VALIDASI OUTPUT
        ==================================================
        */
        $indexFile = $this->_safePath(
            $output . '/index.html'
        );

        if (!file_exists($indexFile)) {

            throw new Exception(
                "Conversion success but output missing"
            );
        }
    }

    /*
    ==================================================
    GET MAX PAGE
    ==================================================
    */
    private function _maxPage($file)
    {
        $html = new DOMDocument();

        @$html->loadHTMLFile($file);

        return $html->getElementsByTagName('a')->length;
    }

    /*
    ==================================================
    READ FILE
    ==================================================
    */
    private function _readFile($file)
    {
        return file_exists($file)
            ? file_get_contents($file)
            : '';
    }

    /*
    ==================================================
    GET EXTENSION
    ==================================================
    */
    private function _getExtension($file)
    {
        return strtolower(
            pathinfo($file, PATHINFO_EXTENSION)
        );
    }

    /*
    ==================================================
    SAFE PATH
    ==================================================
    */
    private function _safePath($path)
    {
        return str_replace(
            '/',
            DIRECTORY_SEPARATOR,
            $path
        );
    }

    /*
    ==================================================
    BASE PATH
    ==================================================
    */
    private function _basePath()
    {
        return realpath(dirname(__FILE__));
    }

    /*
    ==================================================
    PLATFORM
    ==================================================
    */
    private function _platform()
    {
        switch (PHP_OS_FAMILY) {

            case 'Windows':
                return 'win';

            case 'Linux':
                return 'linux';

            case 'Darwin':
                return 'mac';

            default:
                return 'unknown';
        }
    }

    /*
    ==================================================
    BIN DIRECTORY
    ==================================================
    */
    private function _binDir()
    {
        $arch = php_uname('m');

        $folder = (
            strpos($arch, '64') !== false
        )
            ? 'bin64'
            : 'bin32';

        return $this->_safePath(
            $this->_basePath() .
            '/bin/' .
            $this->_platform() .
            '/' .
            $folder
        );
    }

    /*
    ==================================================
    BINARY PATH
    ==================================================
    */
    private function _binPath()
    {
        $file = (
            $this->_platform() === 'win'
        )
            ? 'bin.exe'
            : 'bin';

        return $this->_safePath(
            $this->_binDir() . '/' . $file
        );
    }

    /*
    ==================================================
    TEMP DIRECTORY
    ==================================================
    */
    private function _tempDir()
    {
        $dir = $this->_safePath(
            $this->_binDir() .
            '/tmp/.' .
            $this->tmpHash
        );

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $this->tmpDir = $dir;

        return $dir;
    }

    /*
    ==================================================
    DELETE DIRECTORY RECURSIVE
    ==================================================
    */
    private function _delDirRecursive($dir)
    {
        if (!is_dir($dir)) {
            return;
        }

        foreach (scandir($dir) as $item) {

            if ($item === '.' || $item === '..') {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $item;

            if (is_dir($path)) {
                $this->_delDirRecursive($path);
            } else {
                @unlink($path);
            }
        }

        @rmdir($dir);
    }
}