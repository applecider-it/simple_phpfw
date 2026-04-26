<?php

namespace SFW\Web;

use SFW\Core\Config;

/**
 * Vite管理
 */
class Vite
{
    /** マニフェストのキャッシュ */
    private $manifest = null;

    /** Viteを使用する準備 */
    public function init(): string
    {
        $val = '';

        if ($this->isDev()) {
            $val = '<script type="module" src="' . $this->devUrl() . '/@vite/client"></script>';
        }

        return $val;
    }

    /** Viteアセットのパスをmanifestから返す。 */
    public function asset(string $entry): string
    {
        if ($this->isDev()) {
            return $this->devUrl() . '/' . $entry;
        } else {
            $this->initManifest();

            return '/assets/' . $this->manifest[$entry]['file'];
        }
    }

    /** Manifestを取得 */
    private function initManifest()
    {
        if ($this->manifest === null) {
            $path = SFW_PROJECT_ROOT . '/public/assets/.vite/manifest.json';
            $this->manifest = json_decode(file_get_contents($path), true);
        }
    }

    /** Viteが開発環境か返す */
    private function isDev(): bool
    {
        return Config::get('vite.dev');
    }

    /** 開発環境のURL */
    private function devUrl(): string
    {
        return 'http://localhost:' . Config::get('vite.port');
    }
}
