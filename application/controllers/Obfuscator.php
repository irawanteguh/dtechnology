<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obfuscator extends CI_Controller {

    public function index() {
        // Pastikan Anda sudah menentukan jalur file input dan output
        $inputFilePath  = FCPATH . 'assets/js/auth/sign.js';
        $outputFilePath = FCPATH . 'assets/js/output-obfuscated.js';

        // Jalankan fungsi untuk mengobfuscate file
        $this->obfuscate_js_file($inputFilePath, $outputFilePath);
    }

    private function obfuscate_js_file($inputFilePath, $outputFilePath) {
        // Pastikan file input ada
        if (!file_exists($inputFilePath)) {
            echo "File input tidak ditemukan.";
            return;
        }

        // Baca isi dari file input
        $inputCode = file_get_contents($inputFilePath);

        // Panggil JavaScriptObfuscator melalui Node.js
        $nodeScript = <<<NODE
                        const JavaScriptObfuscator = require('javascript-obfuscator');
                        const fs = require('fs');

                        // Baca konten dari input.js
                        const inputCode = `$inputCode`;

                        // Lakukan obfuscation pada kode
                        const obfuscatedCode = JavaScriptObfuscator.obfuscate(inputCode, {
                            compact: true,
                            controlFlowFlattening: true,
                            deadCodeInjection: true,
                            debugProtection: false,
                            debugProtectionInterval: false,
                            disableConsoleOutput: true,
                            identifierNamesGenerator: 'hexadecimal',
                            log: false,
                            renameGlobals: false,
                            rotateStringArray: true,
                            selfDefending: true,
                            stringArray: true,
                            stringArrayEncoding: ['base64'], // Bisa juga 'rc4'
                            stringArrayThreshold: 0.75,
                            unicodeEscapeSequence: false
                        }).getObfuscatedCode();

                        // Tulis hasil obfuscation ke output file
                        fs.writeFileSync('$outputFilePath', obfuscatedCode);
                        NODE;

        // Simpan sementara script Node.js ke file
        
        $tempScriptPath = FCPATH . 'assets/js/temp_obfuscator.js';
        file_put_contents($tempScriptPath, $nodeScript);

        // Eksekusi script Node.js
        $command = 'node ' . escapeshellarg($tempScriptPath);
        $output = shell_exec($command);

        // Hapus file script sementara
        unlink($tempScriptPath);

        echo "Obfuscation berhasil. File disimpan di: " . $outputFilePath;
    }
}
