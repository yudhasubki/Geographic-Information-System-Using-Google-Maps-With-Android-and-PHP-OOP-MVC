package com.example.yudhaiskandar.trackingpusri;


import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.yudhaiskandar.trackingpusri.Adapter.UserListAdapater;
import com.example.yudhaiskandar.trackingpusri.Model.Pengecer;
import com.example.yudhaiskandar.trackingpusri.R;
import com.example.yudhaiskandar.trackingpusri.Session.SessionManager;


import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;


public class DashboardActivity extends AppCompatActivity {
    StringRequest stringRequest,getStringRequest;
    RequestQueue requestQueue,getRequestQueue;
    TextView aktif,tidakAktif;
    //String url = "http://retailpusri.pe.hu/AndroidWebService/Controller/ParseJson/hitung.php";
    //= "http://192.168.1.8/AndroidWebService/json/hitung.php";
    //String urlString = "http://retailpusri.pe.hu/AndroidWebService/Controller/ParseJson/inactive.php";
    //"http://192.168.1.8/AndroidWebService/json/inactive.php";
    String urlString;
    String url;
    SessionManager sessionManager;
    TextView nama,email;
    Toolbar tb;
    String koneksi;

    Koneksi con = new Koneksi();

    @Override
    public void onCreate(Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        super.onCreate(savedInstanceState);
        setContentView(R.layout.fragment_dashboard);
        tb = (Toolbar)findViewById(R.id.toolbar);
        setSupportActionBar(tb);
        tb.setTitleTextColor(0xFFFFFFFF);
        url = con.getKoneksi()+ "/AndroidWebService/json/hitung.php";
        urlString = con.getKoneksi()+ "/AndroidWebService/json/inactive.php";
        Log.d(" ", "Your Connection is " + url);
        sessionManager = new SessionManager(this);
        aktif = (TextView)findViewById(R.id.Aktif);
        tidakAktif = (TextView)findViewById(R.id.tidakAktif);
        requestQueue = Volley.newRequestQueue(this);
        getRequestQueue = Volley.newRequestQueue(this);
        setAktif();
        setTidakAktif();
        detailUser();
    }

    public void setAktif(){
        stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject jso = new JSONObject(response);
                    aktif.setText(jso.getString("hitung"));
                }catch(JSONException e){
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                String e = error.getMessage();
                Toast.makeText(getApplicationContext(), "Error : " + e, Toast.LENGTH_SHORT).show();
            }
        });
        requestQueue.add(stringRequest);
    }

    public void setTidakAktif(){
        getStringRequest = new StringRequest(urlString, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject jso = new JSONObject(response);
                    tidakAktif.setText(jso.getString("hitung"));
                }catch(JSONException e){
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                String e = error.getMessage();
                Toast.makeText(getApplicationContext(), "Error : " + e, Toast.LENGTH_SHORT).show();
            }
        });
        getRequestQueue.add(getStringRequest);
    }

    public void detailUser(){
        ArrayList detail = sessionManager.getDetail();
        nama = (TextView)findViewById(R.id.namaLogin);
        email = (TextView)findViewById(R.id.emailLogin);
        nama.setText(String.valueOf(detail.get(0)));
        email.setText(String.valueOf(detail.get(1)));
    }

    public void maps(View v){
        Intent i = new Intent(DashboardActivity.this, MapsRetailer.class);
        startActivity(i);
        onPause();
    }

    public void telepon(View v){
        Intent i = new Intent(DashboardActivity.this, ListActivity.class);
        startActivity(i);
        onPause();
    }

    public void logout(View v){
        sessionManager.isLogout();
        ProgressDialog pg = new ProgressDialog(DashboardActivity.this);

        Intent i = new Intent(getApplicationContext(), LoginActivity.class);
        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        i.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        pg.dismiss();
        startActivity(i);
        finish();
    }

}
