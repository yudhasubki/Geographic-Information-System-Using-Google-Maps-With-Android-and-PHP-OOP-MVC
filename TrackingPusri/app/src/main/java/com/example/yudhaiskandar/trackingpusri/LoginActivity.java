package com.example.yudhaiskandar.trackingpusri;


import android.app.ProgressDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.yudhaiskandar.trackingpusri.Session.SessionManager;

import org.json.JSONException;
import org.json.JSONObject;
import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    Button btnLogin;
    EditText username , password;
    StringRequest stringRequest;
    RequestQueue requestQueue;
    SessionManager sessionManager;
    ProgressDialog progressDialog;
    private boolean isButtonClicked = false;

    //private static final String url = "http://retailpusri.pe.hu/AndroidWebService/Controller/ParseJson/login.php";
    String url;
    //"http://192.168.1.8/AndroidWebService/json/login.php";
    Koneksi con = new Koneksi();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        url = con.getKoneksi() + "/AndroidWebService/json/login.php";
        checkLogin();
        initComponents();
        Log.d(" ", "Your Connection is " + url);
        requestQueue = Volley.newRequestQueue(this);
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                click();
                if(v.getId() == R.id.btnLogin){
                    isButtonClicked = !isButtonClicked;
                    v.setBackgroundResource(isButtonClicked ? R.drawable.btn_pressed : R.drawable.btn_shape);
                }
            }
        });


    }
    public void initComponents(){
        btnLogin = (Button)findViewById(R.id.btnLogin);
        username = (EditText)findViewById(R.id.username);
        password = (EditText)findViewById(R.id.password);
        sessionManager = new SessionManager(getApplicationContext());
    }

    public void click(){
        final ProgressDialog pg = new ProgressDialog(LoginActivity.this);
        pg.setMessage("Loggin in...");
        pg.show();
        stringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject jsonObject = new JSONObject(response);
                    pg.dismiss();
                    if(jsonObject.names().get(0).equals("success")){
                        sessionManager.saveData(String.valueOf(jsonObject.get("username")),String.valueOf(jsonObject.getString("email")));
                        Intent i = new Intent(LoginActivity.this, DashboardActivity.class);
                        startActivity(i);
                        finish();
                        Toast.makeText(getApplicationContext(),"Username : "+jsonObject.getString("username"),Toast.LENGTH_SHORT).show();
                    }else{
                        Toast.makeText(getApplicationContext(),"Username / Password Salah",Toast.LENGTH_SHORT).show();
                    }
                }catch(JSONException e){
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                String e = error.getMessage();
                Toast.makeText(getApplicationContext(), "No Internet Connection", Toast.LENGTH_SHORT).show();
            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String,String> hashMap = new HashMap<>();
                hashMap.put("username",username.getText().toString());
                hashMap.put("password",password.getText().toString());
                return hashMap;
            }
        };
        requestQueue.add(stringRequest);
    }

    public void checkLogin(){
        sessionManager = new SessionManager(getApplicationContext());
        if(sessionManager.checkLogin()){
            Intent i = new Intent(LoginActivity.this, DashboardActivity.class);
            i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            i.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(i);
            finish();
        }
    }

}
