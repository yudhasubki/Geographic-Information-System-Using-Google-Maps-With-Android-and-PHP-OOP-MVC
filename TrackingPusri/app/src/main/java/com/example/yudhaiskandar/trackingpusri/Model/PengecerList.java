package com.example.yudhaiskandar.trackingpusri.Model;

/**
 * Created by Yudha Iskandar on 2/12/2017.
 */

public class PengecerList {

    String[] nama;
    String[] kode_pengecer;

    public PengecerList(String[] nama,String[] kode_pengecer){
        this.nama = nama;
        this.kode_pengecer = kode_pengecer;
    }

    public String[] getNama(){
        return nama;
    }

    public String[] getKode(){
        return kode_pengecer;
    }

}
