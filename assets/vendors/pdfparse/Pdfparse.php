<?php

/**
 * Pdfparse - PHP tool to get coordinate (x,y) of text in PDF
 *
 * Requirements:
 * - PHP > 5.6
 * - shell_exec enabled
 * - bin folder writable
 * 
 * LICENSE: MIT
 * @link https://github.com/Saepulawr/pdfparse
 */
class Pdfparse
{
    protected $tmpHash;
    protected $parsedSource = [];
    protected $tmpDir;

    /**
     * Constructor - parse PDF file
     */
    public function __construct($pdfFile)
    {
        libxml_use_internal_errors(true);
        $this->tmpHash = md5(microtime());
        $this->_parse($pdfFile);
    }

    /**
     * Find text coordinates
     * @param string|array $textFind
     * @param bool $caseSensitive
     * @return array
     */
    public function findText($textFind, $caseSensitive = false)
    {
        if (!is_array($textFind)) {
            $textFind = [$textFind];
        }

        $html = new DOMDocument();
        $result = ['page' => [], 'content' => []];

        foreach ($this->parsedSource as $pageIndex => $pageContent) {
            $html->loadHTML($pageContent);
            $pg = $html->getElementById('background');
            $pageNum = $pageIndex + 1;
            if (!isset($result['page']['page' . $pageNum])) {
                $result['page']['page' . $pageNum] = [
                    'width'  => $pg->getAttribute('width'),
                    'height' => $pg->getAttribute('height')
                ];
            }

            foreach ($textFind as $tFind) {
                foreach ($html->getElementsByTagName('div') as $span) {
                    $textContent = $caseSensitive ? $span->textContent : strtolower($span->textContent);
                    $searchText  = $caseSensitive ? $tFind : strtolower($tFind);
                    if (strpos($textContent, $searchText) !== false) {
                        $style = explode(';', $span->getAttribute('style'));
                        $x = $this->_extractNumber($style[1] ?? '0');
                        $y = $this->_extractNumber($style[2] ?? '0');
                        $word = $this->_carikata($span->textContent, $tFind, $caseSensitive);
                        if (!isset($result['content'][$tFind])) $result['content'][$tFind] = [];
                        $result['content'][$tFind][] = [
                            'text' => $word,
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

    /**
     * Cleanup temporary folder
     */
    public function cleanup()
    {
        if (!empty($this->tmpDir) && is_dir($this->tmpDir)) {
            $this->_delDirRecursive($this->tmpDir);
        }
    }

    /**
     * Internal parse PDF
     */
    private function _parse($pdfFile)
    {
        if ($this->_getExtension($pdfFile) !== 'pdf') {
            throw new Exception("File is not PDF: $pdfFile");
        }
        if (!file_exists($pdfFile)) {
            throw new Exception("File does not exist: $pdfFile");
        }

        $pathConverted = $this->_safePath($this->_tempDir() . '/' . basename($pdfFile));
        $this->_convertToHtml($pdfFile, $pathConverted);

        $pathIndexHtml = $this->_safePath($pathConverted . '/index.html');
        if (!file_exists($pathIndexHtml)) {
            throw new Exception("Failed to parse PDF: $pdfFile");
        }

        $maxPage = $this->_maxPage($pathIndexHtml);
        for ($page = 1; $page <= $maxPage; $page++) {
            $pathContent = $this->_safePath($pathConverted . '/page' . $page . '.html');
            $content = $this->_readFile($pathContent);
            $this->parsedSource[] = $content;
        }

        // Jangan hapus tmp di sini, pakai cleanup()
    }

    // ===== Helper Functions =====
    private function _extractNumber($str)
    {
        preg_match_all('!\d+!', $str, $matches);
        return $matches[0][0] ?? 0;
    }

    private function _carikata($sentence, $find, $caseSensitive = false)
    {
        foreach (explode(' ', $sentence) as $word) {
            $haystack = $caseSensitive ? $word : strtolower($word);
            $needle = $caseSensitive ? $find : strtolower($find);
            if (strpos($haystack, $needle) !== false) return $word;
        }
        return '';
    }

    private function _maxPage($fileIndex)
    {
        $html = new DOMDocument();
        $html->loadHTMLFile($fileIndex);
        return $html->getElementsByTagName('a')->length;
    }

    private function _readFile($file)
    {
        return file_exists($file) ? file_get_contents($file) : '';
    }

    private function _safePath($path)
    {
        return str_replace('/', DIRECTORY_SEPARATOR, $path);
    }

    private function _getExtension($file)
    {
        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }

    private function _basePath()
    {
        return realpath(dirname(__FILE__));
    }

    private function _platform()
    {
        $os = strtolower(php_uname('s'));
        switch ($os) {
            case 'darwin': return 'mac';
            case 'linux':  return 'linux';
            case 'winnt':
            case 'windows nt': return 'win';
        }
        return 'unknown';
    }

    private function _binDir()
    {
        $arc = php_uname('m') === 'x86_64' ? 'bin64' : 'bin32';
        return $this->_safePath($this->_basePath() . '/bin/' . $this->_platform() . '/' . $arc);
    }

    private function _binPath()
    {
        $ext = $this->_platform() === 'win' ? '.exe' : '';
        return $this->_safePath($this->_binDir() . '/bin' . $ext);
    }

    private function _tempDir()
    {
        $path = $this->_safePath($this->_binDir() . '/tmp/.' . $this->tmpHash);
        if (!is_dir($path)) mkdir($path, 0777, true);
        $this->tmpDir = $path;
        return $path;
    }

    private function _delDirRecursive($dir)
    {
        if (!is_dir($dir)) return;
        $objects = scandir($dir);
        foreach ($objects as $obj) {
            if ($obj != '.' && $obj != '..') {
                $path = $this->_safePath($dir . '/' . $obj);
                if (is_dir($path)) $this->_delDirRecursive($path);
                else unlink($path);
            }
        }
        rmdir($dir);
    }

    private function _convertToHtml($input, $output)
    {
        $command = $this->_binPath() . ' -q "' . $input . '" "' . $output . '"';
        shell_exec($command);
    }
}
