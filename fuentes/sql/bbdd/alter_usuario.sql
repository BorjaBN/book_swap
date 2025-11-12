ALTER TABLE Usuario
    ADD FOREIGN KEY (id_admin) REFERENCES administrador(id_admin),
    ADD FOREIGN KEY (id_user_comun) REFERENCES user_comun(id_user_comun),
    ADD FOREIGN KEY (id_entidad_cultural) REFERENCES entidad_cultural(id_entidad_cultural);
