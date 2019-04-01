/*超级管理员*/
INSERT INTO `yn_admin` (`admin_id`,`telephone`,`true_name`,`admin_password`, `salt`, `my_password`)
VALUES('551eb08e058611e89534080027de0e0e','9hrgZSF+2SvrGuh8eJCIZw==',  '系统管理员','0192023a7bbd73250516f069df18b500', 'tTJBNZ', 'c45e2de97ddd6be5c4c54c788f3dad09');

/*权限*/
INSERT INTO `yn_permission` (`permission_id`,`permission_name`,`parent_id`,`permission_url`, `permission_key`, `display_order`)
 VALUES
('47d65860058a11e89419080027de0e0e', '信息管理', '', '', 'topMessage','1'),
('5f55e168058a11e88b40080027de0e0e', '网站管理', '', '', 'topSite', '2'),
('6a86728c058a11e8b6b1080027de0e0e', '权限管理', '', '', 'topPermission','3'),

('744af4f0058a11e89b3d080027de0e0e', '样例管理', '47d65860058a11e89419080027de0e0e', 'admincp/sample/list', 'sample','1'),

('7bd7c252058a11e88dfa080027de0e0e', '站点设置', '5f55e168058a11e88b40080027de0e0e', 'admincp/configsite','configsite','1'),
('82fc93a0058a11e8a311080027de0e0e', '省份管理', '5f55e168058a11e88b40080027de0e0e', 'admincp/province/list','province','2'),
('87f62ad8058a11e8bf1e080027de0e0e', '城市管理', '5f55e168058a11e88b40080027de0e0e', 'admincp/city/list','city','3'),

('8d0536f4058a11e88d73080027de0e0e', '管理员管理', '6a86728c058a11e8b6b1080027de0e0e', 'admincp/adminuser/list', 'adminuser','1'),
('9186ffdc058a11e88ae3080027de0e0e', '权限管理', '6a86728c058a11e8b6b1080027de0e0e', 'admincp/permission/list','permission','2'),
('9716d4f4058a11e8a8bd080027de0e0e', '角色管理', '6a86728c058a11e8b6b1080027de0e0e', 'admincp/role/list', 'role','3'),
('9c50858c058a11e89c46080027de0e0e', '修改密码', '6a86728c058a11e8b6b1080027de0e0e', 'admincp/updatepassword', 'updatepassword','4');

/*网站信息*/
LOCK TABLES `yn_config` WRITE;
INSERT INTO `yn_config` (`config_id`,`config_param`,`config_value`)
VALUES
('52ab2600058d11e8be40080027de0e0e','site_name','demo网站'),
('594fea72058d11e891cb080027de0e0e','site_url','www.xxx.com'),
('5f51a60e058d11e8a032080027de0e0e','site_keywords','例子'),
('65ba8b46058d11e8828d080027de0e0e','site_description','这个网站是关于一些例子内容。'),
('6df4acc4058d11e8906a080027de0e0e','site_icp','京ICP备XXXXXXX号-2  京公网安备XXXXXXXX'),
('73d75d80058d11e8a555080027de0e0e','admin_email','admin@xxx.com'),
('7e867964058d11e8b734080027de0e0e','hot_line','800 810 1818 转 5399'),
('842781f6058d11e8ae54080027de0e0e','email_host','mail.xxx.com'),
('8a65c348058d11e8a7b9080027de0e0e','email_username','xxx@xxx.com'),
('90579df8058d11e88af8080027de0e0e','email_password','123456'),
('965f12da058d11e8a80e080027de0e0e','email_port','25'),
('9ce13cd2058d11e8aa72080027de0e0e','email_from','xxx@xxx.com'),
('a2ac9684058d11e8b70c080027de0e0e','email_fromname','例子'),
('a901fa60058d11e8ad17080027de0e0e','web_analytics_top',''),
('afee01e8058d11e8a2b1080027de0e0e','web_analytics_bottom',''),
('b67db508058d11e8ae32080027de0e0e','web_per_page','10'),
('bd7f9f4c058d11e88abd080027de0e0e','admin_per_page','10'),
('f47f75fa073411e88d4d080027de0e0e','check_signature','1');
UNLOCK TABLES;