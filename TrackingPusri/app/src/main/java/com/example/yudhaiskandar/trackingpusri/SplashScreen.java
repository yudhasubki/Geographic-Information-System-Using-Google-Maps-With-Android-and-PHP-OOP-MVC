package com.example.yudhaiskandar.trackingpusri;

import android.content.Intent;
import android.support.v4.view.ViewCompat;
import android.support.v4.view.ViewPropertyAnimatorCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.animation.DecelerateInterpolator;
import android.widget.ImageView;
import android.widget.TextView;

public class SplashScreen extends AppCompatActivity {
    public static final int STARTUP_DELAY = 300;
    public static final int ANIM_ITEM_DURATION = 1000;
    public static final int ITEM_DELAY = 300;

    private boolean animationStarted = false;
    TextView menjadi , terkemuka;
    ImageView splash;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);
    }

    @Override
    public void onWindowFocusChanged(boolean hasFocus){
        if(!hasFocus || animationStarted){
            return;
        }

        animate();
        super.onWindowFocusChanged(hasFocus);
    }

    private void animate(){
        splash = (ImageView)findViewById(R.id.splash);
        menjadi = (TextView)findViewById(R.id.menjadi);
        terkemuka = (TextView)findViewById(R.id.terkemuka);

        ViewCompat.animate(splash)
                .translationY(250)
                .alpha(1)
                .setStartDelay(STARTUP_DELAY)
                .setDuration(ANIM_ITEM_DURATION)
                .setInterpolator(new DecelerateInterpolator(1.2f))
                .start();

        ViewPropertyAnimatorCompat viewAnimator;

        viewAnimator = ViewCompat.animate(menjadi)
                        .translationY(-50).alpha(1)
                        .setStartDelay(500)
                        .setDuration(1000);
        ViewCompat.animate(terkemuka).translationY(-50).alpha(1).setStartDelay(500).setDuration(1000);

        viewAnimator.setInterpolator(new DecelerateInterpolator()).start();

        Thread thread = new Thread(){
            public void run(){
                try{
                    sleep(3000);
                }catch (InterruptedException e){
                    e.printStackTrace();
                }finally{
                    Intent i = new Intent(SplashScreen.this,LoginActivity.class);
                    startActivity(i);
                    finish();
                }
            }
        };

        thread.start();

    }
}
