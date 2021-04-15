# Тестовое задание
  
### При разработке использовалась сборка локального сервера XAMPP  
Фронтенд - форма с валидацией на JS, отправка формы на сервер через fetch Api;  
Бекенд - данные, пришедшие с фронтенда, записываются в базу при помощи PDO, на фронтенд отправляется ответ в формате JSON,  
статус 200 - операция прошла успешно, статус 500 - возникли ошибки,  
  
  
### Таблица бд  

CREATE TABLE `test`.`error_reports`   
( `id` VARCHAR(24) NOT NULL ,  
`name` VARCHAR(30) NOT NULL ,   
`email` VARCHAR(50) NOT NULL ,   
`phone` VARCHAR(15) NOT NULL ,   
`message` TEXT NOT NULL ,  
`image` VARCHAR(50) NOT NULL ,  
`status` BOOLEAN NOT NULL ) ENGINE = InnoDB;  
