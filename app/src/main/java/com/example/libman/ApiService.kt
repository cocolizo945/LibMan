package com.example.libman

import retrofit2.Call
import retrofit2.http.GET

interface ApiService {
   @GET("/indexAut")
   fun fetchAllUsers() : Call<List<Autores>>

}