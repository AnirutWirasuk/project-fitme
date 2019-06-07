package com.ffme.fitforme;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.TextInputLayout;
import android.support.v7.widget.Toolbar;
import android.text.TextUtils;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;

import java.io.File;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.ExecutionException;

import android.widget.ArrayAdapter;
import android.widget.Toast;

import com.google.gson.Gson;

import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;
import pl.aprilapps.easyphotopicker.DefaultCallback;
import pl.aprilapps.easyphotopicker.EasyImage;
import com.wang.avi.AVLoadingIndicatorView;

import static com.ffme.fitforme.R.*;


public class ValidationRegister extends BaseActivityTransparentToolbar {
    private Spinner spinner2;
    HashMap<Integer, Integer> listMap = new HashMap<>();
    private static final String IMGUR_CLIENT_ID = "9199fdef135c122";
    private static final MediaType MEDIA_TYPE = MediaType.parse("image/*");

    String img_profile;
    private File fileProfile;

    private EditText enteredFirstname;
    private TextInputLayout editFirstname;
    private String textFirstname;

    private EditText enteredLastname;
    private TextInputLayout editLastname;
    private String textLastname;

    private EditText enteredPhonenumber;
    private TextInputLayout editPhonenumber;
    private String textPhonenumber;

    private Integer intDisease;
    private TextInputLayout editDisease;

    private EditText enteredEmail;
    private TextInputLayout editEmail;
    private static String textEmail;

    private EditText enteredPassword;
    private TextInputLayout editPassword;
    private String textPassword;

    private Boolean valiDation = true;

    private AVLoadingIndicatorView avi;

    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);

        setContentView(layout.empty_page_transparent_toolbar);

        FrameLayout contentFrameLayout = (FrameLayout) findViewById(id.content_frame);
        getLayoutInflater().inflate(layout.validation_register_content, contentFrameLayout);
        TextView toolbartitle = (TextView) findViewById(id.toolbar_title);
        toolbartitle.setText("REGISTER");

        toolbar = (Toolbar) findViewById(id.toolbar_transparent);
        toolbar.getBackground().setAlpha(200);

        new OkhttpTask().execute("http://fitme.pe.hu/main/jsondisease");

        spinner2 = (Spinner) findViewById(id.spinner2);

        String indicator=getIntent().getStringExtra("indicator");
        avi = (AVLoadingIndicatorView) findViewById(R.id.avi_id2);
        avi.setIndicator(indicator);
        avi.hide();

        bindWidget();
        setWidgetListener();

    }

    private void bindWidget() {

        enteredFirstname = findViewById(id.validation_first_name_edit);
        editFirstname = findViewById(R.id.validation_first_name);

        enteredLastname = findViewById(R.id.validation_last_name_edit);
        editLastname = findViewById(R.id.validation_last_name);

        enteredPhonenumber = findViewById(R.id.validation_phone_number_edit);
        editPhonenumber = findViewById(R.id.validation_phone_number);

        editDisease = findViewById(R.id.validation_Disease);

        enteredEmail = findViewById(R.id.validation_email_edit);
        editEmail = findViewById(R.id.validation_email);

        enteredPassword = findViewById(R.id.validation_password_edit);
        editPassword = findViewById(R.id.validation_password);

    }

    private void setWidgetListener() {

        // Select profile image
        findViewById(R.id.profile_image).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                EasyImage.openChooserWithGallery(ValidationRegister.this, "Pick source", 0);
            }
        });

        // Check form and submit
        TextView subscribe = (TextView) findViewById(id.login_validation);
        subscribe.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                funValidation();
            }
        });

        // Click black to login page
        final TextView login = (TextView) findViewById(id.register_loginsubmit);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), ValidationLogin.class);
                startActivity(intent);
            }
        });

//        enteredEmail.setOnFocusChangeListener(new View.OnFocusChangeListener() {
//            @Override
//            public void onFocusChange(View v, boolean hasFocus) {
//                if (!hasFocus){
//                    new Checkduplicate().execute();
//                    Toast.makeText(getApplicationContext(), "gggg", 2000).show();
//                }
//            }
//        });

    }

    private void funValidation(){
        textFirstname = enteredFirstname.getText().toString();
        textLastname = enteredLastname.getText().toString();
        textPhonenumber = enteredPhonenumber.getText().toString();
        intDisease = listMap.get(spinner2.getSelectedItemPosition());
        textEmail = enteredEmail.getText().toString();
        textPassword = enteredPassword.getText().toString();

        if(textFirstname.length() < 1){
            editFirstname.setError("Please enter first name");
            valiDation = false;
        }else{
            valiDation = true;
        }

        if(textLastname.length() < 1){
            editLastname.setError("Please enter last name");
            valiDation = false;
        }else{
            valiDation = true;
        }

        if(textPhonenumber.length() < 1){
            editPhonenumber.setError("Please enter phone number");
            valiDation = false;
        }else{
            valiDation = true;
        }

        if(intDisease == 0){
            editDisease.setError("Please select congenital disease");
            valiDation = false;
        }else{
            valiDation = true;
        }

        if(isValidEmail(textEmail) == false){
            editEmail.setError("Please enter email");
            valiDation = false;
        }else{
            valiDation = true;
            new Checkduplicate().execute();
        }

        if(textPassword.length() < 1){
            editPassword.setError("Please enter password");
            valiDation = false;
        }else{
            valiDation = true;
        }

        if(valiDation == true){
            new sentDataServer().execute();
        }
    }


    private void showData(String jsonString) {
        Gson gson = new Gson();
        JsonDisease blog = gson.fromJson(jsonString, JsonDisease.class);

        StringBuilder builder = new StringBuilder();
        builder.setLength(0);

        List<JsonDisease.DiseaseBean> posts = blog.getData();

        String[] list = new String[posts.size()+1];
        int i = 0;

        for (JsonDisease.DiseaseBean post : posts) {
            if(i == 0){
                listMap.put(0,0);
                list[0] = "Select congenital disease";

                listMap.put(1,post.getId());
                list[1] = post.getName();
                i = 2;
            }else{
                listMap.put(i,post.getId());
                list[i] = post.getName();
                i++;
            }
        }

        ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this, layout.spinner_item, list);
        dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner2.setAdapter(dataAdapter);

//        Toast.makeText(this, builder.toString(), Toast.LENGTH_LONG).show();
    }


    @Override
    public void onBackPressed() {

        Intent intent = new Intent(getApplicationContext(), ValidationLogin.class);
        startActivity(intent);

    }

    public final boolean isValidEmail(CharSequence target) {
        if (TextUtils.isEmpty(target)) {
            return false;
        } else {
            return android.util.Patterns.EMAIL_ADDRESS.matcher(target).matches();
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        EasyImage.handleActivityResult(requestCode, resultCode, data, this, new DefaultCallback() {
            @Override
            public void onImagePickerError(Exception e, EasyImage.ImageSource source, int type) {
                //Some error handling
                e.printStackTrace();
            }

            @Override
            public void onImagePicked(File imageFile, EasyImage.ImageSource source, int type) {
                onPhotosReturned(imageFile);
            }

            @Override
            public void onCanceled(EasyImage.ImageSource source, int type) {
                //Cancel handling, you might wanna remove taken photo if it was canceled
//                if (source == EasyImage.ImageSource.CAMERA) {
//                    File photoFile = EasyImage.lastlyTakenButCanceledPhoto(ValidationRegister.this);
//                    if (photoFile != null) photoFile.delete();
//                }
            }
        });
    }

    private void onPhotosReturned(File returnedPhotos) {
        Bitmap myBitmap = BitmapFactory.decodeFile(returnedPhotos.getAbsolutePath());

        ImageView myImage = (ImageView) findViewById(id.profile_image);

        img_profile = returnedPhotos.getAbsolutePath();

        myImage.setImageBitmap(myBitmap);
    }

    private class OkhttpTask extends AsyncTask<String, Void, String> {

        OkHttpClient client = new OkHttpClient();

        @Override
        protected String doInBackground(String... urls) {

            Request.Builder builder = new Request.Builder();
            builder.url(urls[0]);
            Request request = builder.build();
            try {
                Response response = client.newCall(request).execute();
                return response.body().string();
            }catch (Exception e){
                e.printStackTrace();
            }
            return null;
        }
        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            showData(s);
        }
    }

    private class Checkduplicate extends AsyncTask<String, Void, String> {

        OkHttpClient client = new OkHttpClient();

        @Override
        protected String doInBackground(String... urls) {

            MultipartBody.Builder buildernew = new MultipartBody.Builder().setType(MultipartBody.FORM);
            buildernew.addFormDataPart("textEmail", textEmail);
            RequestBody requestBody = buildernew.build();
            Request request = new Request.Builder()
                    .header("Authorization", "Client-ID " + IMGUR_CLIENT_ID)
                    .url("http://fitme.pe.hu/main/checkemail")
                    .post(requestBody)
                    .build();
            try {
                Response response = client.newCall(request).execute();
//                if(s != "ok"){
//                    editEmail.setError("This email is invalid or duplicate");
//                    valiDation = false;
//                }
                return response.body().string();
            }catch (Exception e){
                e.printStackTrace();
            }
            return null;
        }
        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            if(s.equals("no")){
                Toast.makeText(ValidationRegister.this, s, Toast.LENGTH_LONG).show();
                editEmail.setError("This email is invalid or duplicate");
                valiDation = false;
            }
        }
    }

    private class sentDataServer extends AsyncTask<String, Void, String> {

        OkHttpClient client = new OkHttpClient();

        @Override
        protected String doInBackground(String... urls) {

            MultipartBody.Builder buildernew = new MultipartBody.Builder().setType(MultipartBody.FORM);
            buildernew.addFormDataPart("textFirstname", textFirstname);
            buildernew.addFormDataPart("textLastname", textLastname);
            buildernew.addFormDataPart("textPhonenumber", textPhonenumber);
            buildernew.addFormDataPart("intDisease", String.valueOf(intDisease));
            buildernew.addFormDataPart("textEmail", textEmail);
            buildernew.addFormDataPart("textPassword", textPassword);
            if(img_profile != null){
                fileProfile = new File(img_profile);
                buildernew.addFormDataPart("imageProfile", fileProfile.getName(),RequestBody.create(MEDIA_TYPE, fileProfile));
            }
            RequestBody requestBody = buildernew.build();

//            RequestBody requestBody = new MultipartBody.Builder()
//                    .setType(MultipartBody.FORM)
//                    .addFormDataPart("textFirstname", textFirstname)
//                    .addFormDataPart("textLastname", textLastname)
//                    .addFormDataPart("textPhonenumber", textPhonenumber)
//                    .addFormDataPart("intDisease", String.valueOf(intDisease))
//                    .addFormDataPart("textEmail", textEmail)
//                    .addFormDataPart("textPassword", textPassword)
//                    .addFormDataPart("imageProfile", fileProfile.getName(),
//                            RequestBody.create(MEDIA_TYPE, fileProfile))
//                    .build();

            Request request = new Request.Builder()
                    .header("Authorization", "Client-ID " + IMGUR_CLIENT_ID)
                    .url("http://fitme.pe.hu/main/register")
                    .post(requestBody)
                    .build();
            try {
                Response response = client.newCall(request).execute();
                return response.body().string();
            }catch (Exception e){
                e.printStackTrace();
            }
            return null;
        }
        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
//            Toast.makeText(ValidationRegister.this, ""+s, Toast.LENGTH_LONG).show();
            avi.hide();
            Intent intent = new Intent(getApplicationContext(), ValidationLogin.class);
            startActivity(intent);
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            TextView login_validation = (TextView) findViewById(R.id.login_validation);
            login_validation.setVisibility(TextView.INVISIBLE);

            avi.show();
        }
    }

}
