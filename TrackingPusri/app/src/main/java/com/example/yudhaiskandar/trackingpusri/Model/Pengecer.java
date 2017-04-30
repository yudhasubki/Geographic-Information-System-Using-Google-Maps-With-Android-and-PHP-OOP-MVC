package com.example.yudhaiskandar.trackingpusri.Model;

/**
 * Created by Yudha Iskandar on 2/4/2017.
 */

public class Pengecer {

    String[] nama;
    String[] alamat;
    String[] perusahaan;
    String[] lat;
    String[] lng;
    int[] ID;
    String[] provinsi;

    public Pengecer(int[] ID,String[] nama,String[] alamat,String[] perusahaan,String[] lat,String[] lng,String[] provinsi){
        this.nama = nama;
        this.alamat = alamat;
        this.perusahaan = perusahaan;
        this.lat = lat;
        this.lng = lng;
        this.ID = ID;
        this.provinsi = provinsi;
    }

    public String[] getNama(){
        return nama;
    }

    public String[] getAlamat(){
        return alamat;
    }

    public String[] getPerusahaan(){
        return perusahaan;
    }

    public String[] getLat(){
        return lat;
    }

    public String[] getLng(){
        return lng;
    }

    public int[] getID(){
        return ID;
    }

    public String[] getProvinsi(){
        return provinsi;
    }
}
