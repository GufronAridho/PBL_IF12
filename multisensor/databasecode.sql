/*creating a table in the database*/
  CREATE TABLE tb_sensor (
    id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ph float(10),
    tds float(10),
    temp float(10),
    reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );

