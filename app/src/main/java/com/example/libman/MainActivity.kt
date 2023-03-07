package com.example.libman

import android.content.ContextParams
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.Toast
import com.android.volley.*
import com.android.volley.toolbox.HttpHeaderParser
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.google.android.material.textfield.TextInputEditText
import java.nio.charset.Charset
import java.nio.charset.StandardCharsets
import java.security.MessageDigest

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        fun generarSHA1(cadena: String): String {
            val data = cadena.toByteArray(StandardCharsets.UTF_8)
            val sha = MessageDigest.getInstance("SHA-1")
            val result = sha.digest(data)

            val sb = StringBuilder()
            for (b in result) {
                sb.append(String.format("%02x", b))
            }

            return sb.toString()
        }

        val txtUsername=findViewById<TextInputEditText>(R.id.txtUsername)
        val txtPassword=findViewById<TextInputEditText>(R.id.passText)
        val btnLogin=findViewById<Button>(R.id.btnLogin)

        btnLogin.setOnClickListener{
            val username:String=txtUsername.text.toString()
            val password:String=txtPassword.text.toString()
            val sha1 = generarSHA1(password)

            loginRequest(username,sha1)
        }
    }

    private fun loginRequest(username: String, password: String) {
        val url = "https://quinoid-miles.000webhostapp.com/ws/indexUsr.php"
        val queue = Volley.newRequestQueue(this)
        val stringRequest = object : StringRequest(Method.POST, url, Response.Listener { response ->
            if (response.trim().equals("success")) {
                    val intent = Intent(this, MainActivity2:: class.java)
                    startActivity(intent)
                Toast.makeText(this, "Welcome", Toast.LENGTH_SHORT).show()
            } else {
                Toast.makeText(this, "check your data", Toast.LENGTH_LONG).show()
            }
        }, Response.ErrorListener { error ->
            Toast.makeText(this, error.message, Toast.LENGTH_LONG).show()
        }) {
            @Throws(AuthFailureError::class)
            override fun getBodyContentType(): String {
                return "application/x-www-form-urlencoded; charset=UTF-8"
            }

            @Throws(AuthFailureError::class)
            override fun getParams(): Map<String, String> {
                val params = HashMap<String, String>()
                params["usuario"] = username
                params["password"] = password
                return params
            }

            override fun parseNetworkResponse(response: NetworkResponse): Response<String> {
                var responseString = ""
                if (response != null) {
                    responseString = String(response.data, Charset.forName("UTF-8"))
                }
                return Response.success(responseString, HttpHeaderParser.parseCacheHeaders(response))
            }
        }
        queue.add(stringRequest)

    }
}