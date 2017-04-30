package com.example.yudhaiskandar.trackingpusri;


import android.content.IntentSender;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.graphics.PorterDuff;
import android.graphics.drawable.Drawable;
import android.location.Location;
import android.os.Build;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AutoCompleteTextView;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.SimpleAdapter;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import com.akexorcist.googledirection.DirectionCallback;
import com.akexorcist.googledirection.GoogleDirection;
import com.akexorcist.googledirection.config.GoogleDirectionConfiguration;
import com.akexorcist.googledirection.constant.TransportMode;
import com.akexorcist.googledirection.model.Direction;
import com.akexorcist.googledirection.model.Info;
import com.akexorcist.googledirection.model.Leg;
import com.akexorcist.googledirection.model.Route;
import com.akexorcist.googledirection.util.DirectionConverter;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.common.api.PendingResult;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.common.api.Status;
import com.google.android.gms.location.LocationListener;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.LocationSettingsRequest;
import com.google.android.gms.location.LocationSettingsResult;
import com.google.android.gms.location.LocationSettingsStates;
import com.google.android.gms.location.LocationSettingsStatusCodes;
import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.GoogleMap.OnInfoWindowClickListener;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.PolylineOptions;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;



public class MapsRetailer extends AppCompatActivity implements OnMapReadyCallback,GoogleApiClient.ConnectionCallbacks,GoogleApiClient.OnConnectionFailedListener,LocationListener,OnInfoWindowClickListener
{
    StringRequest stringRequest, getStringRequest, stringRequest3,stringInfo;
    RequestQueue requestQueue, getRequestQueue, getGetRequestQueue,requestInfo;
    private GoogleMap mMap;
    private GoogleApiClient mGoogleApiClient;
    private LocationRequest mLocationRequest;
    private Location mLocation;
    private static final String[] LOCATION_PERMS={

    };
    private static final int LOCATION_REQUEST=1337;
    TextView jarakMobil, waktu;
    String[] kode_pengecer;
    String[] nama_pengecer;
    AutoCompleteTextView text;
    ImageButton cari;
    Spinner spinner;
    //String url = "http://retailpusri.pe.hu/AndroidWebService/Controller/ParseJson/marker.php";
    //String urlData = "http://retailpusri.pe.hu/AndroidWebService/Controller/ParseJson/kode-pengecer.php";
    String url;
    String urlData;
    String[] lat;
    String[] lng;
    String[] nama;
    String[] alamat;
    String[] provinsi;
    String[] perusahaan;
    Toolbar toolbar;
    String Snippet;
    Drawable upArrow;
    TextView NAMA,ALAMAT,PERUSAHAAN;
    Koneksi con = new Koneksi();
    private ArrayList<HashMap<String,String>> autoComplete = new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps_retailer);
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        CheckUserPermissions();
        mapFragment.getMapAsync(this);
        url = con.getKoneksi() + "/AndroidWebService/json/marker.php";
        urlData = con.getKoneksi() + "/AndroidWebService/json/kode-pengecer.php";
        text = (AutoCompleteTextView) findViewById(R.id.autoCompleteTextView);
        jarakMobil = (TextView) findViewById(R.id.jarakMobil);
        waktu = (TextView) findViewById(R.id.waktu);
        requestQueue = Volley.newRequestQueue(this);
        getRequestQueue = Volley.newRequestQueue(this);
        getGetRequestQueue = Volley.newRequestQueue(this);
        cari = (ImageButton) findViewById(R.id.cari);
        setLocation();
        getKodePengecer();
        getMarker();
        getToolbar();
        cari.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                mMap.clear();
                getDirect();
                getKodePengecer();
                getMarker();
            }
        });
    }


    public void getDirect() {
        stringRequest3 = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                try {
                    JSONObject json = new JSONObject(response);
                    if (json.names().get(0).equals("success")) {
                        String serverKey = "AIzaSyCNlDfNXa9WaNugAM60s8wgnqz0WKnXxsI";
                        if (mLocation != null) {
                            LatLng myLoc = new LatLng(mLocation.getLatitude(), mLocation.getLongitude());
                            Double Lat = Double.parseDouble(String.valueOf(json.getString("lat")));
                            Double Long = Double.parseDouble(String.valueOf(json.getString("lng")));
                            final LatLng TO = new LatLng(Lat, Long);
                            GoogleDirection.withServerKey(serverKey).from(myLoc).to(TO).transportMode(TransportMode.DRIVING).execute(new DirectionCallback() {
                                @Override
                                public void onDirectionSuccess(Direction direction, String rawBody) {
                                    Route route = direction.getRouteList().get(0);
                                    Leg leg = route.getLegList().get(0);
                                    Info distanceInfo = leg.getDistance();
                                    Info timeInfo = leg.getDuration();
                                    String totalDistance = distanceInfo.getText();
                                    String totalTime = timeInfo.getText();
                                    jarakMobil.setText(totalDistance);
                                    waktu.setText(totalTime);
                                    ArrayList<LatLng> directionPosition = leg.getDirectionPoint();
                                    PolylineOptions polylineOptions = DirectionConverter.createPolyline(getApplicationContext(), directionPosition, 5, Color.RED);
                                    mMap.addPolyline(polylineOptions);
                                    mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(TO, 15));
                                }

                                @Override
                                public void onDirectionFailure(Throwable t) {

                                }
                            });

                        }


                    } else {
                        Log.d("Message", "JSON Error");
                        Toast.makeText(getApplicationContext(), "Alamat Tidak Di Temukan", Toast.LENGTH_SHORT).show();
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
                data.put("kode_pengecer", text.getText().toString());
                return data;
            }
        };
        getGetRequestQueue.add(stringRequest3);
    }


    public void getMarker() {
        getStringRequest = new StringRequest(urlData, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray jsonArray = jsonObject.getJSONArray("result");
                    lat = new String[jsonArray.length()];
                    lng = new String[jsonArray.length()];
                    nama = new String[jsonArray.length()];
                    kode_pengecer = new String[jsonArray.length()];
                    perusahaan = new String[jsonArray.length()];
                    alamat = new String[jsonArray.length()];
                    provinsi = new String[jsonArray.length()];

                    if (mLocation != null) {
                        LatLng myLoc = new LatLng(mLocation.getLatitude(), mLocation.getLongitude());
                        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(myLoc, 15));
                        mMap.addMarker(new MarkerOptions().position(myLoc).snippet("Here!"));
                    }

                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject data = jsonArray.getJSONObject(i);
                        lat[i] = data.getString("lat");
                        lng[i] = data.getString("long");
                        nama[i] = data.getString("nama_pengecer");
                        kode_pengecer[i] = data.getString("kode_pengecer");
                        alamat[i] = data.getString("alamat");
                        provinsi[i] = data.getString("provinsi");
                        perusahaan[i] = data.getString("perusahaan");
                    }

                    Double[] LAT = new Double[lat.length];
                    Double[] LONG = new Double[lng.length];

                    for (int i = 0; i < lat.length; i++) {
                        LAT[i] = Double.parseDouble(lat[i]);
                        LONG[i] = Double.parseDouble(lng[i]);
                        Marker marker = mMap.addMarker(new MarkerOptions().position(new LatLng(LAT[i], LONG[i])).title("Pengecer").icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_AZURE)));
                        Snippet = "Nama Pengecer " + nama[i];
                        marker.setSnippet(Snippet);
                        Log.d("Message", "Nama Pengecer " + nama[i]);
                    }

                    mMap.setInfoWindowAdapter(new GoogleMap.InfoWindowAdapter() {
                        @Override
                        public View getInfoWindow(Marker marker) {
                            return null;
                        }

                        @Override
                        public View getInfoContents(Marker myMarker) {
                            View v = LayoutInflater.from(MapsRetailer.this).inflate(R.layout.info_window,null);

                            NAMA = (TextView)v.findViewById(R.id.namaRetailer);
                            ALAMAT = (TextView)v.findViewById(R.id.alamatRetailer);
                            PERUSAHAAN = (TextView)v.findViewById(R.id.perusahaanRetailer);
                            ImageButton b = (ImageButton)v.findViewById(R.id.getDirect);
                            for(int i = 0;i<lat.length;i++){
                                if(myMarker.getSnippet().equals("Nama Pengecer " + nama[i])){
                                    NAMA.setText(String.valueOf(nama[i]));
                                    ALAMAT.setText(String.valueOf(alamat[i]));
                                    PERUSAHAAN.setText(String.valueOf(perusahaan[i]));
                                }else if(myMarker.getSnippet().equals("Here!")){
                                    NAMA.setText("Here!");
                                    ALAMAT.setText("");
                                    PERUSAHAAN.setText("");
                                }
                            }
                            return v;
                        }
                    });

                    Log.d("Message", "ini nama " + nama);
                    if (ActivityCompat.checkSelfPermission(MapsRetailer.this, android.Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(MapsRetailer.this, android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                        return;
                    }
                    mMap.setMyLocationEnabled(true);

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
        getRequestQueue.add(getStringRequest);
    }

    public void getKodePengecer() {
        stringRequest = new StringRequest(urlData, new Response.Listener<String>() {
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
                        item.put("NM",data.getString("perusahaan"));
                        autoComplete.add(item);
                    }
                    SimpleAdapter sa = new SimpleAdapter(MapsRetailer.this,autoComplete, android.R.layout.simple_list_item_2,new String[] {"KD","NM"},new int[]{android.R.id.text1, android.R.id.text2});
                    text.setAdapter(sa);
                    text.setThreshold(1);
                    text.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                        @Override
                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                            try {
                                String json = parent.getItemAtPosition(position).toString();
                                json = json.replace("{","{'");
                                json = json.replace("=","':'");
                                json = json.replace(", ","', '");
                                json = json.replace("}","'}");
                                JSONObject jsonObject = new JSONObject(json);

                                text.setText(jsonObject.getString("KD") + "-" + jsonObject.getString("NM"));

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

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
        GoogleDirectionConfiguration.getInstance().isLogEnabled();
        mMap.setOnInfoWindowClickListener(MapsRetailer.this);
    }

    public void runListener() {

    }

    public void CheckUserPermissions() {
        if (Build.VERSION.SDK_INT >= 22) {
            if (ActivityCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_FINE_LOCATION) !=
                    PackageManager.PERMISSION_GRANTED) {
                requestPermissions(new String[]{
                                android.Manifest.permission.ACCESS_FINE_LOCATION},
                        REQUEST_CODE_ASK_PERMISSIONS);
                return;
            }
        }

        runListener();
    }

    final private int REQUEST_CODE_ASK_PERMISSIONS = 123;

    @Override
    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {
        switch (requestCode) {
            case REQUEST_CODE_ASK_PERMISSIONS:
                if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                    runListener();
                } else {
                    // Apabila permission di denied
                    Toast.makeText(this, "Tidak Bisa di Akses!", Toast.LENGTH_SHORT)
                            .show();
                }
                break;
            default:
                super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        }
    }

    public void getToolbar(){
        toolbar = (Toolbar)findViewById(R.id.toolbar);
        upArrow = getResources().getDrawable(R.drawable.ic_arrow_back_black_24dp);
        upArrow.setColorFilter(getResources().getColor(R.color.layout), PorterDuff.Mode.SRC_ATOP);
        setSupportActionBar(toolbar);
        getSupportActionBar().setHomeAsUpIndicator(upArrow);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        toolbar.setTitleTextColor(0xFFFFFFFF);
    }

    @Override
    protected void onStart() {
        mGoogleApiClient.connect();
        super.onStart();
    }

    @Override
    protected void onStop() {
        mGoogleApiClient.disconnect();
        super.onStop();
    }


    @Override
    protected void onResume() {
        super.onResume();
        mGoogleApiClient.connect();
    }

    @Override
    protected void onPause() {
        super.onPause();

        if (mGoogleApiClient.isConnected()) {
            LocationServices.FusedLocationApi.removeLocationUpdates(mGoogleApiClient, this);
            mGoogleApiClient.disconnect();
        }
    }

    private void setLocation(){
        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .addApi(LocationServices.API)
                .build();

        mLocationRequest = LocationRequest.create()
                .setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY)
                .setInterval(10 * 1000)        // 10 seconds, in milliseconds
                .setFastestInterval(1 * 1000); // 1 second, in milliseconds


        LocationSettingsRequest.Builder builder = new LocationSettingsRequest.Builder()
                .addLocationRequest(mLocationRequest);
        PendingResult<LocationSettingsResult> result =
                LocationServices.SettingsApi.checkLocationSettings(mGoogleApiClient,
                        builder.build());
        result.setResultCallback(new ResultCallback<LocationSettingsResult>() {
            @Override
            public void onResult(LocationSettingsResult result) {
                final Status status = result.getStatus();
                final LocationSettingsStates state = result.getLocationSettingsStates();
                switch (status.getStatusCode()) {
                    case LocationSettingsStatusCodes.SUCCESS:

                        break;
                    case LocationSettingsStatusCodes.RESOLUTION_REQUIRED:
                        try {
                            status.startResolutionForResult(MapsRetailer.this,100);
                        } catch (IntentSender.SendIntentException e) {
                            // Ignore the error.
                        }
                        break;
                    case LocationSettingsStatusCodes.SETTINGS_CHANGE_UNAVAILABLE:

                        break;
                }
            }
        });
        mGoogleApiClient.connect();
    }


    private void handleNewLocation(Location location) {
        Log.e("", location.toString());
        double currentLatitude = location.getLatitude();
        double currentLongitude = location.getLongitude();

        LatLng latLng = new LatLng(currentLatitude, currentLongitude);

        mLocation = location;
    }

    @Override
    public void onConnected(@Nullable Bundle bundle) {
        if (ActivityCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                requestPermissions(LOCATION_PERMS, LOCATION_REQUEST);
            }
            return;
        }
        LocationServices.FusedLocationApi.requestLocationUpdates(mGoogleApiClient, mLocationRequest, MapsRetailer.this);
    }

    @Override
    public void onConnectionSuspended(int i) {

    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {

    }

    @Override
    public void onLocationChanged(Location location) {
        handleNewLocation(location);
    }

    @Override
    public void onInfoWindowClick(Marker myMarker) {
        String serverKey = "AIzaSyCNlDfNXa9WaNugAM60s8wgnqz0WKnXxsI";
        Double[] LAT = new Double[lat.length];
        Double[] LONG = new Double[lng.length];
        for(int i = 0;i<lat.length;i++){
            if(myMarker.getSnippet().equals("Nama Pengecer " + nama[i])){
                if (mLocation != null) {
                    mMap.clear();
                    getKodePengecer();
                    getMarker();
                    LatLng myLoc = new LatLng(mLocation.getLatitude(), mLocation.getLongitude());
                    LAT[i] = Double.parseDouble(lat[i]);
                    LONG[i] = Double.parseDouble(lng[i]);
                    LatLng TO = new LatLng(LAT[i], LONG[i]);
                    GoogleDirection.withServerKey(serverKey).from(myLoc).to(TO).transportMode(TransportMode.DRIVING).execute(new DirectionCallback() {
                        @Override
                        public void onDirectionSuccess(Direction direction, String rawBody) {
                            Route route = direction.getRouteList().get(0);
                            Leg leg = route.getLegList().get(0);
                            Info distanceInfo = leg.getDistance();
                            Info timeInfo = leg.getDuration();
                            String totalDistance = distanceInfo.getText();
                            String totalTime = timeInfo.getText();
                            jarakMobil.setText(totalDistance);
                            waktu.setText(totalTime);
                            ArrayList<LatLng> directionPosition = leg.getDirectionPoint();
                            PolylineOptions polylineOptions = DirectionConverter.createPolyline(getApplicationContext(), directionPosition, 5, Color.RED);
                            mMap.addPolyline(polylineOptions);
                        }

                        @Override
                        public void onDirectionFailure(Throwable t) {

                        }
                    });

                }
            }else{

            }
        }

    }
}



