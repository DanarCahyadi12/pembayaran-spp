<?php

class SiswaModel
{
    private $db;
    private $query;
    private $bind;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSiswa()
    {
        $this->db->query('SELECT * FROM siswa LIMIT 1000');
        $this->db->execute();
        return $this->db->results();
    }

    public function createSiswa($datas)
    {
        $this->db->query('INSERT INTO siswa (nama_lengkap,NIS,NISN,kelas,jurusan,jenis_kelamin,fk_admin) VALUES(:nama,:NIS,:NISN,:kelas,:jurusan,:jenisKelamin,:fk_admin)');
        $this->db->binds($datas);
        $this->db->bind('fk_admin', Session::get('user')['id']);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaByName($nama)
    {
        $this->db->query('SELECT * FROM siswa WHERE nama_lengkap = :nama');
        $this->db->bind('nama', $nama);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaByNIS($nis)
    {
        $this->db->query('SELECT * FROM siswa WHERE NIS = :nis');
        $this->db->bind('nis', $nis);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaByNISN($nisn)
    {
        $this->db->query('SELECT * FROM siswa WHERE NISN = :nisn');
        $this->db->bind('nisn', $nisn);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaLimit($limit, $orderBy = null)
    {

        if (is_null($orderBy)) {
            $this->query = 'SELECT * FROM siswa LIMIT :limits';
        } else {
            $this->query = "SELECT * FROM siswa ORDER BY " . $orderBy . " LIMIT :limits";
        }
        $this->db->query($this->query);
        $this->db->bind('limits', $limit);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaById($id)
    {
        $this->db->query('SELECT * FROM siswa WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function getSiswaByIdIsNot($id)
    {
        $this->db->query('SELECT * FROM siswa WHERE id != :id LIMIT 100');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->results();
    }

    public function deleteSiswa($id)
    {
        $this->db->query('DELETE FROM siswa WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getAllSiswaByKelasAndJurusan($kelas, $jurusan)
    {
        $this->db->query('SELECT * FROM siswa WHERE kelas = :kelas AND jurusan = :jurusan');
        $this->db->binds([
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ]);

        $this->db->execute();
        return $this->db->results();
    }


    public function getAllSiswaByKelas($kelas)
    {
        $this->db->query('SELECT * FROM siswa WHERE kelas = :kelas');
        $this->db->bind('kelas', $kelas);
        $this->db->execute();
        return $this->db->results();
    }
    public function getAllSiswaByJurusan($jurusan)
    {
        $this->db->query('SELECT * FROM siswa WHERE jurusan = :jurusan');
        $this->db->bind('jurusan', $jurusan);
        $this->db->execute();
        return $this->db->results();
    }

    public function searchSiswa($query, $filter = null)
    {


        if (is_null($filter)) {
            $this->query = "SELECT * FROM siswa WHERE nama_lengkap LIKE '%{$query}%' OR NIS LIKE '%{$query}%' OR NISN LIKE '%{$query}%' OR kelas LIKE  '%{$query}%' OR jurusan LIKE '%{$query}%' LIMIT 1000";
        }
        if (!empty($filter['kelas'])) {

            $this->query = "SELECT * FROM siswa WHERE (nama_lengkap LIKE '%{$query}%' OR NIS LIKE '%{$query}%' OR NISN LIKE '%{$query}%') AND (kelas = :kelas) LIMIT 1000";

            $this->bind = [
                'param' => 'kelas',
                'value' => $filter['kelas']
            ];
        }
        if (!empty($filter['jurusan'])) {
            $this->query = "SELECT * FROM siswa WHERE (nama_lengkap LIKE '%{$query}%' OR NIS LIKE '%{$query}%' OR NISN LIKE '%{$query}%') AND (jurusan = :jurusan) LIMIT 1000";
            $this->bind = [
                'param' => 'jurusan',
                'value' => $filter['jurusan']
            ];
        }
        if ( !empty($filter['jurusan']) && !empty($filter['kelas']) && !empty($query) ) {
            $this->query = "SELECT * FROM siswa WHERE (nama_lengkap LIKE '%{$query}%' OR NIS LIKE '%{$query}%' OR NISN LIKE '%{$query}%') AND (jurusan = :jurusan AND kelas = '{$filter['kelas']}') LIMIT 1000";
            $this->bind = [
                'param' => 'jurusan',
                'value' => $filter['jurusan']
            ];
        }

        $this->db->query($this->query);
        if (!is_null($this->bind)){
            $this->db->bind($this->bind['param'], $this->bind['value']);

        } 
        $this->db->execute();
        return $this->db->results();
    }

    public function updateSiswa($datas, $idSiswa)
    {
        $this->db->query('UPDATE siswa SET nama_lengkap = :nama_lengkap,NIS = :NIS ,NISN = :NISN, jenis_kelamin = :jenis_kelamin,jurusan = :jurusan,kelas = :kelas WHERE id = :id');
        $this->db->binds($datas);
        $this->db->bind('id', $idSiswa);
        return $this->db->execute();
    }

    public function getSiswaPaidByIdAndYear($id, $year)
    {
        $this->db->query("SELECT siswa.* , pembayaran.bulan FROM siswa INNER JOIN pembayaran ON siswa.id = pembayaran.fk_siswa WHERE siswa.id = :id AND pembayaran.tahun = :tahun");
        $this->db->bind('id', $id);
        $this->db->bind('tahun', $year);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaPaidByBulan($bulan) {
        $this->db->query("SELECT siswa.* FROM siswa INNER JOIN pembayaran ON siswa.id = pembayaran.fk_siswa WHERE pembayaran.bulan = :bulan");
        $this->db->bind('bulan', $bulan);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaNotPaidByBulan($bulan) {
        $this->db->query("SELECT * FROM siswa WHERE id NOT IN(SELECT fk_siswa FROM pembayaran WHERE bulan = :bulan)");
        $this->db->bind('bulan', $bulan);
        $this->db->execute();
        return $this->db->results();
    }

    public function getSiswaPaidById($id) {
        $this->db->query("SELECT siswa.*,pembayaran.bulan FROM siswa INNER JOIN pembayaran ON pembayaran.fk_siswa = siswa.id WHERE siswa.id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->results();
    }


    public function getSiswaByUsernameExceptId($nama_lengkap,$id) {
        $this->db->query('SELECT * FROM siswa WHERE nama_lengkap = :nama_lengkap AND id != :id');
        $this->db->bind('nama_lengkap',$nama_lengkap);
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->result();
    }
    public function getSiswaByNISExceptId($NIS,$id) {
        $this->db->query('SELECT * FROM siswa WHERE NIS = :NIS AND id != :id');
        $this->db->bind('NIS',$NIS);
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->result();
    }
    public function getSiswaByNISNExceptId($NISN,$id) {
        $this->db->query('SELECT * FROM siswa WHERE NISN = :NISN AND id != :id');
        $this->db->bind('NISN',$NISN);
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->result();
    }
}
