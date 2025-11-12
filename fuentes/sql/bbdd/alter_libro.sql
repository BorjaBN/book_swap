ALTER TABLE Libro
    ADD FOREIGN KEY (id_catalogo) REFERENCES Catalogo_libro(id_admin),
    ADD FOREIGN KEY (id_user_comun) REFERENCES user_comun(id_user_comun);
