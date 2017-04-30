package com.example.yudhaiskandar.trackingpusri.Adapter;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.BitmapDrawable;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.yudhaiskandar.trackingpusri.Model.Pengecer;
import com.example.yudhaiskandar.trackingpusri.R;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;


public class UserListAdapater extends RecyclerView.Adapter<UserListAdapater.ViewHolderItem> {

    Context context;
    List<Pengecer> pengecer = new ArrayList<>();
    String [] Nama;
    String [] Alamat;
    String [] Perusahaan;
    String [] Provinsi;
    int[] ID;

    public UserListAdapater(Context context,int[] ID, String[] Nama, String[] Alamat,String[] Perusahaan,String[] Provinsi){
        this.context = context;
        this.ID = ID;
        this.Nama = Nama;
        this.Alamat = Alamat;
        this.Perusahaan = Perusahaan;
        this.Provinsi = Provinsi;
    }

    @Override
    public UserListAdapater.ViewHolderItem onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(context).inflate(R.layout.custom_info, null);
        ViewHolderItem viewHolder = new ViewHolderItem(v);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(UserListAdapater.ViewHolderItem holder, int position) {
        holder.nama.setText(Nama[position]);
        holder.alamat.setText(Alamat[position]);
        holder.perusahaan.setText(Perusahaan[position]);
        holder.provinsi.setText(Provinsi[position]);
    }

    @Override
    public int getItemCount() {
        return Nama.length;
    }

    public class ViewHolderItem extends RecyclerView.ViewHolder  {
        TextView nama,alamat,perusahaan,provinsi;
        ImageView imageList;
        public ViewHolderItem(View itemView) {
            super(itemView);
            nama = (TextView)itemView.findViewById(R.id.namaRetailer);
            alamat = (TextView)itemView.findViewById(R.id.alamatRetailer);
            perusahaan = (TextView)itemView.findViewById(R.id.perusahaanRetailer);
            provinsi = (TextView)itemView.findViewById(R.id.provinsiRetailer);
            imageList = (ImageView)itemView.findViewById(R.id.imageList);
            imageList.setImageResource(R.drawable.logo);
            imageList.setMaxWidth(100);
            imageList.setMaxHeight(80);
        }

    }
}
