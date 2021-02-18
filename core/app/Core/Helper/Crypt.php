<?php
/**
 * This file is part of Leafiny.
 *
 * Copyright (C) Magentix SARL
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/**
 * Class Core_Helper_Crypt
 */
class Core_Helper_Crypt extends Core_Helper
{
    /**
     * @var string KEY_FILE
     */
    const KEY_FILE = 'crypt.key';
    /**
     * @var string CIPHER_ALGO
     */
    const CIPHER_ALGO = 'aes-128-ctr';

    /**
     * @var string $key
     */
    private $key = '';
    /**
     * @var string $iv
     */
    private $iv = '';

    /**
     * Core_Helper_Crypt constructor
     */
    public function __construct()
    {
        parent::__construct();

        if (!is_file($this->getKeyFile())) {
            $this->saveKey();
        }

        $content = file_get_contents($this->getKeyFile());

        if ($content) {
            $key = explode(':', $content);

            $this->iv  = isset($key[0]) ? $key[0] : '';
            $this->key = isset($key[1]) ? $key[1] : '';
        }
    }

    /**
     * Crypt message
     *
     * @param string $message
     *
     * @return string
     */
    public function crypt(string $message): string
    {
        $result = openssl_encrypt($message, self::CIPHER_ALGO, $this->getKey(), 0, $this->getIv());

        return $result ?: '';
    }

    /**
     * Decrypt message
     *
     * @param string $message
     *
     * @return string
     */
    public function decrypt(string $message): string
    {
        $result = openssl_decrypt($message, self::CIPHER_ALGO, $this->getKey(), 0, $this->getIv());

        return $result ?: '';
    }

    /**
     * Generate a random key with iv
     *
     * @return string
     */
    protected function generate(): string
    {
        $iv  = substr(hash('sha256', uniqid()), 0, 16);
        $key = uniqid('', true) . '.' . rand(10000000, 99999999);

        return $iv . ':' . $key;
    }

    /**
     * Retrieve key file
     *
     * @return string
     */
    protected function getKeyFile(): string
    {
        return $this->getCryptDir() . self::KEY_FILE;
    }

    /**
     * Save a new key
     *
     * @return bool
     */
    protected function saveKey(): bool
    {
        return (bool)file_put_contents($this->getKeyFile(), $this->generate());
    }

    /**
     * Retrieve key
     *
     * @return string
     */
    protected function getKey(): string
    {
        return (string)$this->key;
    }

    /**
     * Retrieve IV
     *
     * @return string
     */
    protected function getIv(): string
    {
        return (string)$this->iv;
    }
}
