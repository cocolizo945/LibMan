package com.example.libman

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.appcompat.view.menu.MenuView.ItemView
import androidx.recyclerview.widget.RecyclerView


class Adapter(private val autores: List<Autores>) : RecyclerView.Adapter<Adapter.ViewHolder>() {



    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context).inflate(R.layout.row_autor,parent,false)
        return ViewHolder(view)
    }

    override fun getItemCount() = autores.size

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
            val autor = autores[position]
            holder.txtId.text = autor.id_aut
            holder.txtNombre.text = autor.nombre
            holder.txtApellido.text = autor.ap
            holder.txtNacionalidad.text = autor.id_nac
    }

    class ViewHolder(itemView : View): RecyclerView.ViewHolder(itemView){
        val txtId: TextView = itemView.findViewById(R.id.txtId)
        val txtNombre : TextView = itemView.findViewById(R.id.txtNombre)
        val txtApellido: TextView = itemView.findViewById(R.id.txtApellido)
        val txtNacionalidad : TextView = itemView.findViewById(R.id.txtNacionalidad)

    }
}