package com.example.yudhaiskandar.trackingpusri;



import android.content.Context;
import android.graphics.PorterDuff;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.os.Handler;
import android.support.v4.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AutoCompleteTextView;
import android.widget.ImageButton;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.yudhaiskandar.trackingpusri.Adapter.UserListAdapater;
import com.example.yudhaiskandar.trackingpusri.Helper.EndlessScroll;
import com.example.yudhaiskandar.trackingpusri.Model.Pengecer;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

/**
 * A simple {@link Fragment} subclass.
 */
public class ListActivity extends AppCompatActivity {
    StringRequest stringRequest,stringRequest2;
    RequestQueue requestQueue,requestQueue2;
    TextView perusahaan;
    JSONArray jsonArray = null;
    String[] Nama;
    String[] Alamat;
    String[] Perusahaan;
    String[] Lat;
    String[] Long;
    String[] kode_pengecer;
    String[] nama_pengecer;
    int[] ID;
    String[] Provinsi;
    String KEY_NAMA = "nama_pengecer";
    String KEY_ALAMAT = "alamat";
    String KEY_PERUSAHAAN = "nama_perusahaan";
    String KEY_LAT = "lat";
    String KEY_LNG = "lng";
    String KEY_ID = "id_pengecer";
    String KEY_PROVINSI = "provinsi";
    RecyclerView rv;
    Context context;
    Drawable upArrow;
    //private static final String url = "http://retailpusri.pe.hu/AndroidWebService/Controller/ParseJson/data_pengecer.php";
    String url;
    String url2;
    ImageButton cari;
    AutoCompleteTextView autoCompleteTextView;
    Toolbar tb;
    private ArrayList<HashMap<String,String>> autoComplete = new ArrayList<>();
    EndlessScroll scrollListener;
    private SwipeRefreshLayout mSwipeRefreshLayout;
    Koneksi con = new Koneksi();
    public ListActivity() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.fragment_list_user);
        tb = (Toolbar)findViewById(R.id.toolbar);
        setSupportActionBar(tb);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        tb.setTitle("PT PUPUK SRIWIDJAJA");
        tb.setTitleTextColor(0xFFFFFFFF);
        upArrow = getResources().getDrawable(R.drawable.ic_arrow_back_black_24dp);
        upArrow.setColorFilter(getResources().getColor(R.color.layout), PorterDuff.Mode.SRC_ATOP);
        getSupportActionBar().setHomeAsUpIndicator(upArrow);
        url = con.getKoneksi() + "/AndroidWebService/json/data_pengecer.php";
        url2 = con.getKoneksi() + "/AndroidWebService/json/list-cari.php";
        mSwipeRefreshLayout = (SwipeRefreshLayout) findViewById(R.id.activity_main_swipe_refresh_layout);
        cari = (ImageButton)findViewById(R.id.cari);
        autoCompleteTextView = (AutoCompleteTextView)findViewById(R.id.autoCompleteTextView);
        requestQueue = Volley.newRequestQueue(this);
        requestQueue2 = Volley.newRequestQueue(this);
        rv = (RecyclerView)findViewById(R.id.recycler);
        semuaData();
        getKodePengecer();
        mSwipeRefreshLayout.setColorSchemeResources(R.color.headerColor, R.color.colorAccent, R.color.colorPrimary);
        mSwipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        semuaData();
                        mSwipeRefreshLayout.setRefreshing(false);
                    }
                }, 2500);
            }
        });
        cari.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                cariList();
            }
        });
    }

    public void semuaData(){
        stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject jso = new JSONObject(response);
                    jsonArray = jso.getJSONArray("result");

                    Log.d("tag", "Data ada "+ jsonArray.length());
                    Nama = new String[jsonArray.length()];
                    Alamat = new String[jsonArray.length()];
                    Perusahaan = new String[jsonArray.length()];
                    Lat = new String[jsonArray.length()];
                    Long = new String[jsonArray.length()];
                    ID = new int[jsonArray.length()];
                    Provinsi = new String[jsonArray.length()];

                    for(int i=0;i<jsonArray.length();i++){
                        JSONObject data = jsonArray.getJSONObject(i);
                        ID[i] = data.getInt(KEY_ID);
                        Nama[i] = data.getString(KEY_NAMA);
                        Alamat[i] = data.getString(KEY_ALAMAT);
                        Perusahaan[i] = data.getString(KEY_PERUSAHAAN);
                        Lat[i] = data.getString(KEY_LAT);
                        Long[i] = data.getString(KEY_LNG);
                        Provinsi[i] = data.getString(KEY_PROVINSI);
                    }

                    Pengecer pengecer = new Pengecer(ID,Nama,Alamat,Perusahaan,Lat,Long,Provinsi);
                    final UserListAdapater ula = new UserListAdapater(getApplicationContext(),pengecer.getID(),pengecer.getNama(),pengecer.getAlamat(),pengecer.getPerusahaan(),pengecer.getProvinsi());
                    LinearLayoutManager LM = new LinearLayoutManager(getApplicationContext());
                    rv.setAdapter(ula);
                    rv.setLayoutManager(LM);
                    rv.setHasFixedSize(true);
                    rv.setItemViewCacheSize(20);
                    rv.setDrawingCacheEnabled(true);
                    rv.setDrawingCacheQuality(View.DRAWING_CACHE_QUALITY_HIGH);
                    scrollListener = new EndlessScroll(LM) {
                        @Override
                        public void onLoadMore(int page, int totalItemsCount, RecyclerView view) {
                            final int curSize = ula.getItemCount();
                            view.post(new Runnable() {
                                @Override
                                public void run() {
                                    ula.notifyItemRangeInserted(curSize, 5);
                                }
                            });
                        }
                    };

                    rv.addOnScrollListener(scrollListener);
                    ula.notifyDataSetChanged();
                }catch(JSONException e){
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                String e = error.getMessage();
                Toast.makeText(getApplicationContext(), "Couldnt Refresh List", Toast.LENGTH_SHORT).show();
            }
        });
        requestQueue.add(stringRequest);
    }


    public void getKodePengecer()
    {
        stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray jsonArray = jsonObject.getJSONArray("result");
                    kode_pengecer = new String[jsonArray.length()];
                    nama_pengecer = new String[jsonArray.length()];
                    HashMap<String,String> item;
                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject data = jsonArray.getJSONObject(i);
                        kode_pengecer[i] = data.getString("kode_pengecer");
                        nama_pengecer[i] = data.getString("nama_pengecer");
                        item  = new HashMap<>();
                        item.put("KD",data.getString("kode_pengecer"));
                        item.put("NM",data.getString("nama_perusahaan"));
                        autoComplete.add(item);
                    }
                    SimpleAdapter sa = new SimpleAdapter(ListActivity.this,autoComplete, android.R.layout.simple_list_item_2,new String[] {"KD","NM"},new int[]{android.R.id.text1, android.R.id.text2});
                    autoCompleteTextView.setAdapter(sa);
                    autoCompleteTextView.setThreshold(1);
                    autoCompleteTextView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                        @Override
                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                            try {
                                String json = parent.getItemAtPosition(position).toString();
                                json = json.replace("{","{'");
                                json = json.replace("=","':'");
                                json = json.replace(", ","', '");
                                json = json.replace("}","'}");
                                JSONObject jsonObject = new JSONObject(json);

                                autoCompleteTextView.setText(jsonObject.getString("KD") + "-" + jsonObject.getString("NM"));

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    });
                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });
        requestQueue.add(stringRequest);
    }

    public void cariList() {
        stringRequest2 = new StringRequest(Request.Method.POST, url2, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject json = new JSONObject(response);
                    if (json.names().get(0).equals("result")) {
                        jsonArray = json.getJSONArray("result");
                        Nama = new String[jsonArray.length()];
                        Alamat = new String[jsonArray.length()];
                        Perusahaan = new String[jsonArray.length()];
                        Lat = new String[jsonArray.length()];
                        Long = new String[jsonArray.length()];
                        ID = new int[jsonArray.length()];
                        Provinsi = new String[jsonArray.length()];

                        for(int i=0;i<jsonArray.length();i++){
                            JSONObject data = jsonArray.getJSONObject(i);
                            ID[i] = data.getInt(KEY_ID);
                            Nama[i] = data.getString(KEY_NAMA);
                            Alamat[i] = data.getString(KEY_ALAMAT);
                            Perusahaan[i] = data.getString(KEY_PERUSAHAAN);
                            Lat[i] = data.getString(KEY_LAT);
                            Long[i] = data.getString(KEY_LNG);
                            Provinsi[i] = data.getString(KEY_PROVINSI);
                        }

                        Pengecer pengecer = new Pengecer(ID,Nama,Alamat,Perusahaan,Lat,Long,Provinsi);
                        final UserListAdapater ula = new UserListAdapater(getApplicationContext(),pengecer.getID(),pengecer.getNama(),pengecer.getAlamat(),pengecer.getPerusahaan(),pengecer.getProvinsi());
                        LinearLayoutManager LM = new LinearLayoutManager(getApplicationContext());
                        rv.setAdapter(ula);
                        rv.setLayoutManager(LM);
                        rv.setHasFixedSize(true);
                        rv.setItemViewCacheSize(20);
                        rv.setDrawingCacheEnabled(true);
                        rv.setDrawingCacheQuality(View.DRAWING_CACHE_QUALITY_HIGH);
                        ula.notifyDataSetChanged();
                    } else {
                        Log.d("Message", "JSON Error");
                        Toast.makeText(getApplicationContext(), "Data Tidak Di Temukan", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    Log.d("Message", "JSON Error" + e.getMessage());
                    Toast.makeText(getApplicationContext(), "Error Catch" + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("Message", "JSON Error" + error.getMessage());
                Toast.makeText(getApplicationContext(), "Error Response" + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> data = new HashMap<>();
                data.put("kode_pengecer", autoCompleteTextView.getText().toString());
                return data;
            }
        };
        requestQueue2.add(stringRequest2);
    }



}
