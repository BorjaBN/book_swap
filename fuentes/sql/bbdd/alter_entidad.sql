ALTER TABLE Entidad_cultural
    ADD FOREIGN KEY (id_admin) REFERENCES administrador(id_admin),
    ADD FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    ADD FOREIGN KEY (id_evento) REFERENCES evento_cultural(id_evento);
