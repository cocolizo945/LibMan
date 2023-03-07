package com.example.libman

import android.annotation.SuppressLint
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.MenuItem
import android.widget.Button
import android.widget.TextSwitcher
import android.widget.Toast
import androidx.appcompat.app.ActionBarDrawerToggle
import androidx.drawerlayout.widget.DrawerLayout
import com.google.android.material.navigation.NavigationView

class MainActivity2 : AppCompatActivity() {
    lateinit var toggle: ActionBarDrawerToggle
    var firsPressTime:Long = 0

    override fun onCreate(savedInstanceState: Bundle?) {

        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main2)

        val drawerLayout: DrawerLayout = findViewById(R.id.drawerLayout)
        val navView: NavigationView = findViewById(R.id.nav_view)

        //llamada de la barra lateral
        toggle = ActionBarDrawerToggle(this, drawerLayout, R.string.open, R.string.close)
        drawerLayout.addDrawerListener(toggle)
        toggle.syncState()

        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        navView.setNavigationItemSelectedListener {

            when (it.itemId) {
                R.id.nav_home -> {
                    //item home en main2
                    Toast.makeText(this,"Already in home", Toast.LENGTH_SHORT).show()
                }

                R.id.nav_logout -> {
                    //item log out para cerrar sesion
                    val intent = Intent(this, MainActivity:: class.java)
                    startActivity(intent)
                    finish()
                }
            }
            true
        }
        //abrir actividad nueva con botones
        val btnAutores = findViewById<Button>(R.id.btnAut)
        val btnEdito = findViewById<Button>(R.id.btnEdito)
        val btnLib = findViewById<Button>(R.id.btnLib)
        val btnNac = findViewById<Button>(R.id.btnNac)
        val btnTem = findViewById<Button>(R.id.btnTem)
        var mynum  = 2

        btnAutores.setOnClickListener{
            mynum=1
            val intent = Intent(this, General:: class.java)
            intent.putExtra("mynum",mynum)
            startActivity(intent)
            finish()
        }
        btnEdito.setOnClickListener{
            mynum=2
            val intent = Intent(this, General:: class.java)
            intent.putExtra("mynum",mynum)
            startActivity(intent)
            finish()
        }
        btnLib.setOnClickListener{
            mynum=3
            val intent = Intent(this, General:: class.java)
            intent.putExtra("mynum",mynum)
            startActivity(intent)
            finish()
        }
        btnNac.setOnClickListener{
            mynum=4
            val intent = Intent(this, General:: class.java)
            intent.putExtra("mynum",mynum)
            startActivity(intent)
            finish()
        }
        btnTem.setOnClickListener{
            mynum=5
            val intent = Intent(this, General:: class.java)
            intent.putExtra("mynum",mynum)
            startActivity(intent)
            finish()
        }
    }

    //seleccion de opciones segun el item
        override fun onOptionsItemSelected(item: MenuItem): Boolean {

            if (toggle.onOptionsItemSelected(item)) {
                return true
            }
            return super.onOptionsItemSelected(item)
        }

    //dos atras para cerrar sesion
    override fun onBackPressed() {
        if (firsPressTime+1000 > System.currentTimeMillis()){
            super.onBackPressed()
            }else{
                Toast.makeText(this,"press back again to exit",Toast.LENGTH_SHORT).show()
        }
        firsPressTime= System.currentTimeMillis()
        finish()
        }


    }
