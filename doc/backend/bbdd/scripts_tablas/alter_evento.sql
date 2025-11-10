ALTER TABLE Evento_cultural
    ADD FOREIGN KEY (id_entidad_cultural) REFERENCES Entidad_cultural(id_entidad_cultural),
    ADD FOREIGN KEY (id_administrador) REFERENCES Administrador(id_admin);
