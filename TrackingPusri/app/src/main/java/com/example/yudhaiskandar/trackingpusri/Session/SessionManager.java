package com.example.yudhaiskandar.trackingpusri.Session;

import android.content.Context;
import android.content.SharedPreferences;

import java.util.ArrayList;


public class SessionManager {
    Context context;
    SharedPreferences sharedPreferences;

    public SessionManager(Context context){
        sharedPreferences = context.getSharedPreferences("myRef", Context.MODE_PRIVATE);
    }

    public void saveData(String UserName,String Email){
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString("UserName", UserName);
        editor.putString("Email", Email);
        editor.putBoolean("IsLoggedIn", true);
        editor.commit();
    }

    public boolean checkLogin(){
        boolean check = sharedPreferences.getBoolean("IsLoggedIn", false);
        return check;
    }

    public ArrayList getDetail(){
        ArrayList detail = new ArrayList();
        detail.add(sharedPreferences.getString("UserName","No Session"));
        detail.add(sharedPreferences.getString("Email","No Email"));
        detail.add(sharedPreferences.getBoolean("IsLoggedIn",false));
        return detail;
    }

    public void isLogout(){
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.commit();
    }

    public String loadData(){
        String FileContent = sharedPreferences.getString("UserName","No Username");
        FileContent += "IsLoggedIn"+sharedPreferences.getBoolean("IsLoggedIn", false);
        return FileContent;
    }
}
