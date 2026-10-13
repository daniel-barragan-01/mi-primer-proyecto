USE casinos;
INSERT INTO casinos (nombre, direccion, telefono_sala, lider_sala, technicians, policia, security_company, security_phone, security_email, security_notes, camaras, horarios)
VALUES
('Casino Verano Cajamarca','Calle 7 Numero 6-04','3174324367','José Ignacio / Laura Hernández','Cristian Góngora(3229224008); Jhan Moscoso(3154449809); Brandon Ortiz(3162514626); Joseph Valencia(3167955818); Yuli Rengifo(3174220928)','3013460530','COOVICOMBEIMA','3174236686','coovicombeima@gmail.com','Don Leonardo es el único autorizado para cambios de clave.','[1,8,13,16]','{"lt":{"ingreso":"08:30","apertura":"09:30","cierre":"00:00","salida":"01:00"},"vs":{"ingreso":"08:30","apertura":"09:30","cierre":"00:00","salida":"01:00"},"df":{"ingreso":"10:30","apertura":"12:00","cierre":"20:00","salida":"20:30"}}'),
('Casino Verano Acqua','Cra 9 No. 57 - 24C CC Acqua (Loc 410) Hacienda Piedra Pintada','3162100520','Salomón Espinoza','(no techs listed)','6082685012','COOVICOMBEIMA','3174236686','coovicombeima@gmail.com','Don Leonardo es el único autorizado para cambios de clave.','[1,5,20,11]','{"lt":{"ingreso":"09:00","apertura":"10:00","cierre":"12:00","salida":"01:00"},"vs":{"ingreso":"09:00","apertura":"10:00","cierre":"01:00","salida":"02:00"},"df":{"ingreso":"12:00","apertura":"13:30","cierre":"21:00","salida":"22:00"}}');

-- create default admin user (username: admin, password: admin123)
-- To create admin user run in MySQL with PHP: INSERT INTO users (username,password_hash) VALUES ('admin',PASSWORD('admin123')); -- or use the provided PHP snippet to generate a proper bcrypt hash
