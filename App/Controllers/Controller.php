<?php

namespace App\Controllers;

use DBConnection;

class Controllers
{

    protected $eposta;
    protected $sifre;
    protected $imza;

    protected  $con;


    protected $result = [];

    /**
     * Controllers constructor.
     *
     * @param $eposta
     * @param $sifre
     * @param $imza
     */
    public function __construct($eposta, $sifre, $imza)
    {
        $this->eposta = $eposta;
        $this->sifre  = $sifre;
        $this->imza   = $imza;

        $db  = new DBConnection();
        $this->con = $db->connect();
    }

    /**
     * @param $imza
     *
     * @return array
     */
    public function isSignature($imza)
    {
        //TODO
        /* İmza kısmını (token) veritabanına bağlamadım. Laravel'de JWT kullanarak yapmıştım.
            OAuth ile tecrübem olmadı.
        */

        return [
            'kod'  => '0',
            'hata' => '1'
        ];

    }

    // Eposta veya sifre doğru mu
    /**
     * @return array
     */
    public function isPasswordEmailTrue()
    {



        // Bilgisi istenen kişinin varlığını kontrol et.
        $query = $this->con->prepare('SELECT * FROM phpapi.uyeler WHERE eposta = ? AND parola = ?');
        $query->execute([$this->eposta, $this->sifre]);

        // İlgili verilere ait veri yoksa
        if ($query->rowCount() === 0) {
            $this->result = [
                'kod'  => '0',
                'hata' => '2',
            ];
            http_response_code(500);

            return $this->result;
        }

        // Herhangi bir veri bulunduysa
        foreach ($query->fetchAll() as $row) {
            $this->result = [
                'kod' => '1',
                'uye' => [
                    [
                        'id'      => $row['id'],
                        'isim'    => $row['isim'],
                        'soyisim' => $row['soyisim'],
                        'eposta'  => $row['eposta']
                    ]
                ]

            ];
        }
        return $this->result;
    }
}
