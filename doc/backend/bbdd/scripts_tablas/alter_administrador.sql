ALTER TABLE Administrador
    ADD FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    ADD FOREIGN KEY (id_user_comun) REFERENCES User_comun(id_user_comun),
    ADD FOREIGN KEY (id_entidad_cultural) REFERENCES Entidad_cultural(id_entidad_cultural),
    ADD FOREIGN KEY (id_evento) REFERENCES Evento_cultural(id_evento);
