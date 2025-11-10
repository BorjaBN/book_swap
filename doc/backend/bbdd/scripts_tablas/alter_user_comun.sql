ALTER TABLE User_comun
    ADD FOREIGN KEY (id_admin) REFERENCES Administrador(id_admin),
    ADD FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario);
