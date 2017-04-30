package com.example.yudhaiskandar.trackingpusri.Adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.yudhaiskandar.trackingpusri.Model.PengecerList;
import com.example.yudhaiskandar.trackingpusri.R;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.Marker;

import java.util.ArrayList;

/**
 * Created by Yudha Iskandar on 2/13/2017.
 */

public class InfoWindow extends RecyclerView.Adapter<InfoWindow.ViewHolderItem> {
    Context context;
    String [] Nama;
    String [] Alamat;

    public InfoWindow(Context context,String[] Nama,String[] Alamat){
        this.context = context;
        this.Nama = Nama;
        this.Alamat = Alamat;

    }

    @Override
    public InfoWindow.ViewHolderItem onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(context).inflate(R.layout.custom_info,null);
        ViewHolderItem viewHolderItem = new ViewHolderItem(v);
        return viewHolderItem;
    }

    @Override
    public void onBindViewHolder(ViewHolderItem holder, int position) {
        holder.NAMA.setText(Nama[position]);
        holder.ALAMAT.setText(Alamat[position]);
    }

    @Override
    public int getItemCount() {
        return Nama.length;
    }

    public class ViewHolderItem extends RecyclerView.ViewHolder {
        TextView NAMA,ALAMAT;
        public ViewHolderItem(View itemView) {
            super(itemView);
            NAMA = (TextView)itemView.findViewById(R.id.namaRetailer);
            ALAMAT = (TextView)itemView.findViewById(R.id.alamatRetailer);
        }
    }
}
