<?php

namespace App\UseCase;

class DosenUC
{
    private $nidn;
    private $nama;
    private $tempatLahir;
    private $tanggalLahir;
    private $nik;
    private $jenisKelamin;
    private $nomerHp;
    private $alamat;

    /**
     * @param $nidn
     * @param $nama
     * @param $tempatLahir
     * @param $tanggalLahir
     * @param $nik
     * @param $jenisKelamin
     * @param $nomerHp
     * @param $alamat
     */
    public function __construct($nidn, $nama, $tempatLahir, $tanggalLahir, $nik, $jenisKelamin, $nomerHp, $alamat)
    {
        $this->nidn = $nidn;
        $this->nama = $nama;
        $this->tempatLahir = $tempatLahir;
        $this->tanggalLahir = $tanggalLahir;
        $this->nik = $nik;
        $this->jenisKelamin = $jenisKelamin;
        $this->nomerHp = $nomerHp;
        $this->alamat = $alamat;
    }


    /**
     * @return mixed
     */
    public function getNidn()
    {
        return $this->nidn;
    }

    /**
     * @param mixed $nidn
     */
    public function setNidn($nidn): void
    {
        $this->nidn = $nidn;
    }

    /**
     * @return mixed
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * @param mixed $nama
     */
    public function setNama($nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return mixed
     */
    public function getTempatLahir()
    {
        return $this->tempatLahir;
    }

    /**
     * @param mixed $tempatLahir
     */
    public function setTempatLahir($tempatLahir): void
    {
        $this->tempatLahir = $tempatLahir;
    }

    /**
     * @return mixed
     */
    public function getTanggalLahir()
    {
        return $this->tanggalLahir;
    }

    /**
     * @param mixed $tanggalLahir
     */
    public function setTanggalLahir($tanggalLahir): void
    {
        $this->tanggalLahir = $tanggalLahir;
    }

    /**
     * @return mixed
     */
    public function getNik()
    {
        return $this->nik;
    }

    /**
     * @param mixed $nik
     */
    public function setNik($nik): void
    {
        $this->nik = $nik;
    }

    /**
     * @return mixed
     */
    public function getJenisKelamin()
    {
        return $this->jenisKelamin;
    }

    /**
     * @param mixed $jenisKelamin
     */
    public function setJenisKelamin($jenisKelamin): void
    {
        $this->jenisKelamin = $jenisKelamin;
    }

    /**
     * @return mixed
     */
    public function getNomerHp()
    {
        return $this->nomerHp;
    }

    /**
     * @param mixed $nomerHp
     */
    public function setNomerHp($nomerHp): void
    {
        $this->nomerHp = $nomerHp;
    }

    /**
     * @return mixed
     */
    public function getAlamat()
    {
        return $this->alamat;
    }

    /**
     * @param mixed $alamat
     */
    public function setAlamat($alamat): void
    {
        $this->alamat = $alamat;
    }


}
