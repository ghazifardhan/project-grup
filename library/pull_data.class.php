<?php

require "Query.php";
require "leech_data.php";

class PullData
{
    private $data;
    private $query;
    private $tipe_soal;
    private $jenjang;
    private $matpel;

    /**
     * get last inputed tipe_soal_id
     * @return int
     */
    private function getLastTipeSoalId()
    {
        $hsl = $this->query->getLastId("tipe_soal","id");
        return $hsl;
    }

    /**
     * get last inputed pertanyaan_id
     * @return int
     */
    private function getLastPertanyaanId()
    {
        $hsl = $this->query->getLastId("pertanyaan","id");
        return $hsl;
    }

    private function genSetValueForTipeSoal()
    {
        $setValue = "judul = '".$this->tipe_soal."', matpel_id='".$this->matpel."',jenjang='".$this->jenjang."'";

        return $setValue;
    }

    /**
     * pasang datanya
     * @param String $tipe_soal judul soal (UN APA TAHUN BRP)
     * @param String $jenjang   jenjangnya apa (SD,SMP,SMA)
     * @param int $matpel    matpelnya apa (liat di db)
     */
    public function __construct($tipe_soal,$jenjang,$matpel,$link)
    {
        $this->tipe_soal = $tipe_soal;
        $this->jenjang = $jenjang;
        $this->matpel = $matpel;

        $this->query = new Query;
        $this->data = leechData($link);
    }

    /**
     * getData bwt debug
     * @return mixed array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * insert to DB
     */
    public function setToDB()
    {
        $cek = $this->query->insert("tipe_soal",$this->genSetValueForTipeSoal());
        $tipe_soal_id = $this->getLastTipeSoalId();

        foreach($this->data as $key => $value)
        {
            $setValue = "no=".($key+1).",nama='".$value['pertanyaan']."',tipe_soal_id='".$tipe_soal_id."'";
            $this->query->insert('pertanyaan',$setValue);
            $pertanyaan_id = $this->getLastPertanyaanId();

            for($i = 0 ; $i < count($value['jawaban']) ; $i++)
            {
                $tipe = 0;
                if($i+1 == $value["kunci"]){
                    $tipe = 1;
                }
                $setValue_pilihan = "nama_jawaban='".$value['jawaban'][$i]."',pertanyaan_id='".$pertanyaan_id."',tipe='".$tipe."'";
                $this->query->insert('pilihan',$setValue_pilihan);
            }

        }
    }

}
