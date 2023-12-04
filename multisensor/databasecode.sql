
/*creating a table in the database*/
CREATE TABLE tb_sensor (
  id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ph varchar(10),
  tds varchar(10),
  temp varchar(10),
  reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

