package com.example.libman

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.MenuItem
import android.widget.TextView
import androidx.appcompat.app.ActionBarDrawerToggle
import androidx.drawerlayout.widget.DrawerLayout
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import androidx.recyclerview.widget.RecyclerView.LayoutManager
import com.android.volley.toolbox.Volley
import com.google.android.material.navigation.NavigationView
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory


class General : AppCompatActivity() {
    lateinit var toggle: ActionBarDrawerToggle

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_general)

        val retrofit = Retrofit.Builder()
            .baseUrl("https://quinoid-miles.000webhostapp.com/ws")
            .addConverterFactory(GsonConverterFactory.create())
            .build()
        val recyclerview = findViewById<RecyclerView>(R.id.recyclerView)
        recyclerview.layoutManager = LinearLayoutManager(this)
        val data = ArrayList<Autores>()
        for (i in 1..20) {
            data.add(Autores(R.drawable.baseline_home_24.toString(), "i" + i))
        }


        val api = retrofit.create(ApiService::class.java)
        api.fetchAllUsers().enqueue(object : Callback<List<Autores>>{
            override fun onResponse(call: Call<List<Autores>>, response: Response<List<Autores>>) {

            }

            override fun onFailure(call: Call<List<Autores>>, t: Throwable) {

            }

        })


        val drawerLayout: DrawerLayout = findViewById(R.id.drawerLayout1)
        val navView: NavigationView = findViewById(R.id.nav_view)
        var url = ""


            val txtTabla = findViewById<TextView>(R.id.Tabla)

            val intent = intent
            val mynum = intent.getIntExtra("mynum",0)

        //cambio de nombre del textview
            when (mynum) {
                1 -> {txtTabla.text ="com.example.libman.Autores"

                    val queue = Volley.newRequestQueue(this)
                    url = "https://quinoid-miles.000webhostapp.com/ws/indexAut.php" }
                2 -> {txtTabla.text ="Editoriales"
                    url = "https://quinoid-miles.000webhostapp.com/ws/indexEdito.php"}
                3 -> {txtTabla.text ="Libros"
                    url = "https://quinoid-miles.000webhostapp.com/ws/indexLib.php"}
                4 -> {txtTabla.text ="Nacionalidad"
                    url = "https://quinoid-miles.000webhostapp.com/ws/indexNac.php"}
                5 -> {txtTabla.text ="Temas"
                    url = "https://quinoid-miles.000webhostapp.com/ws/indexTem.php"}
                else -> "Invalid Table"
            }





        //llamada de la barra lateral
        toggle = ActionBarDrawerToggle(this, drawerLayout, R.string.open, R.string.close)
        drawerLayout.addDrawerListener(toggle)
        toggle.syncState()

        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        navView.setNavigationItemSelectedListener {

            when (it.itemId) {
                R.id.nav_home -> {
                    //item home en main2
                    val intent = Intent(this, MainActivity2::class.java)
                    startActivity(intent)
                    finish()
                }

                R.id.nav_logout -> {
                    //item log out para cerrar sesion
                    val intent = Intent(this, MainActivity::class.java)
                    startActivity(intent)
                    finish()
                }
            }
            true
        }
    }

    //seleccion de opciones segun el item
    override fun onOptionsItemSelected(item: MenuItem): Boolean {

        if (toggle.onOptionsItemSelected(item)) {
            return true
        }
        return super.onOptionsItemSelected(item)
    }

}