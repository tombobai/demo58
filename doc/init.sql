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

/*省份*/
LOCK TABLES `yn_province` WRITE;
INSERT INTO `yn_province` VALUES ('7b9556d8059911e8b016080027de0e0e', '北京市', '1', '0', '0');
INSERT INTO `yn_province` VALUES ('7b961f64059911e88e9a080027de0e0e', '天津市', '2', '0', '0');
INSERT INTO `yn_province` VALUES ('7b964ea8059911e8b69a080027de0e0e', '河北省', '3', '0', '0');
INSERT INTO `yn_province` VALUES ('7b968f58059911e88bbb080027de0e0e', '山西省', '4', '0', '0');
INSERT INTO `yn_province` VALUES ('7b96bbb8059911e8bbd7080027de0e0e', '内蒙古自治区', '5', '0', '0');
INSERT INTO `yn_province` VALUES ('7b9710fe059911e88699080027de0e0e', '辽宁省', '6', '0', '0');
INSERT INTO `yn_province` VALUES ('7b974718059911e89d4b080027de0e0e', '吉林省', '7', '0', '0');
INSERT INTO `yn_province` VALUES ('7b978ea8059911e8bc93080027de0e0e', '黑龙江省', '8', '0', '0');
INSERT INTO `yn_province` VALUES ('7b97dd36059911e89183080027de0e0e', '上海市', '9', '0', '0');
INSERT INTO `yn_province` VALUES ('7b982ce6059911e895b3080027de0e0e', '江苏省', '10', '0', '0');
INSERT INTO `yn_province` VALUES ('ed1e39aa059911e8b501080027de0e0e', '浙江省', '11', '0', '0');
INSERT INTO `yn_province` VALUES ('ed1ee9cc059911e8b36b080027de0e0e', '安徽省', '12', '0', '0');
INSERT INTO `yn_province` VALUES ('ed1f3c42059911e8a3f7080027de0e0e', '福建省', '13', '0', '0');
INSERT INTO `yn_province` VALUES ('ed1f996c059911e8b875080027de0e0e', '江西省', '14', '0', '0');
INSERT INTO `yn_province` VALUES ('ed1fd404059911e88ecb080027de0e0e', '山东省', '15', '0', '0');
INSERT INTO `yn_province` VALUES ('ed200b72059911e89c1f080027de0e0e', '河南省', '16', '0', '0');
INSERT INTO `yn_province` VALUES ('ed203886059911e8b4bd080027de0e0e', '湖北省', '17', '0', '0');
INSERT INTO `yn_province` VALUES ('ed208f16059911e885b1080027de0e0e', '湖南省', '18', '0', '0');
INSERT INTO `yn_province` VALUES ('ed20c67a059911e89e0d080027de0e0e', '广东省', '19', '0', '0');
INSERT INTO `yn_province` VALUES ('ed211152059911e8a01c080027de0e0e', '广西壮族自治区', '20', '0', '0');
INSERT INTO `yn_province` VALUES ('ed21679c059911e8891b080027de0e0e', '海南省', '21', '0', '0');
INSERT INTO `yn_province` VALUES ('ed21c02a059911e8b90b080027de0e0e', '重庆市', '22', '0', '0');
INSERT INTO `yn_province` VALUES ('ed21f2ac059911e899ff080027de0e0e', '四川省', '23', '0', '0');
INSERT INTO `yn_province` VALUES ('ed2259b8059911e889fd080027de0e0e', '贵州省', '24', '0', '0');
INSERT INTO `yn_province` VALUES ('ed22a418059911e8a052080027de0e0e', '云南省', '25', '0', '0');
INSERT INTO `yn_province` VALUES ('ed23053e059911e8b374080027de0e0e', '西藏自治区', '26', '0', '0');
INSERT INTO `yn_province` VALUES ('ed237456059911e8a1a9080027de0e0e', '陕西省', '27', '0', '0');
INSERT INTO `yn_province` VALUES ('ed23b934059911e8a1ae080027de0e0e', '甘肃省', '28', '0', '0');
INSERT INTO `yn_province` VALUES ('ed23f674059911e89129080027de0e0e', '青海省', '29', '0', '0');
INSERT INTO `yn_province` VALUES ('ed243792059911e8ba0e080027de0e0e', '宁夏回族自治区', '30', '0', '0');
INSERT INTO `yn_province` VALUES ('ed249516059911e89e15080027de0e0e', '新疆维吾尔自治区', '31', '0', '0');
INSERT INTO `yn_province` VALUES ('ed24f204059911e8b955080027de0e0e', '香港特别行政区', '32', '0', '0');
INSERT INTO `yn_province` VALUES ('ed25323c059911e8a740080027de0e0e', '澳门特别行政区', '33', '0', '0');
INSERT INTO `yn_province` VALUES ('ed256f04059911e8a0a2080027de0e0e', '台湾', '34', '0', '0');
UNLOCK TABLES;

/*城市*/
LOCK TABLES `yn_city` WRITE;
INSERT INTO `yn_city` VALUES ('04fad8ac059b11e8b3ac080027de0e0e', '7b9556d8059911e8b016080027de0e0e', '北京市', '1', '1', '0', '0');
INSERT INTO `yn_city` VALUES ('04fb3b08059b11e8ac89080027de0e0e', '7b961f64059911e88e9a080027de0e0e', '天津市', '1', '2', '0', '0');
INSERT INTO `yn_city` VALUES ('04fb55ca059b11e8ab2f080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '石家庄市', '1', '3', '0', '0');
INSERT INTO `yn_city` VALUES ('04fb715e059b11e8842b080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '唐山市', '1', '4', '0', '0');
INSERT INTO `yn_city` VALUES ('04fb823e059b11e892af080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '秦皇岛市', '1', '5', '0', '0');
INSERT INTO `yn_city` VALUES ('04fbb51a059b11e8bf9c080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '邯郸市', '1', '6', '0', '0');
INSERT INTO `yn_city` VALUES ('04fbcd66059b11e8a69c080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '邢台市', '1', '7', '0', '0');
INSERT INTO `yn_city` VALUES ('04fbe832059b11e8ad7d080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '保定市', '1', '8', '0', '0');
INSERT INTO `yn_city` VALUES ('04fc2b62059b11e89f0a080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '张家口市', '1', '9', '0', '0');
INSERT INTO `yn_city` VALUES ('04fc49ee059b11e88e8e080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '承德市', '1', '10', '0', '0');
INSERT INTO `yn_city` VALUES ('04fc5934059b11e88a12080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '沧州市', '1', '11', '0', '0');
INSERT INTO `yn_city` VALUES ('04fc6d66059b11e88621080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '廊坊市', '1', '12', '0', '0');
INSERT INTO `yn_city` VALUES ('04fca86c059b11e88244080027de0e0e', '7b964ea8059911e8b69a080027de0e0e', '衡水市', '1', '13', '0', '0');
INSERT INTO `yn_city` VALUES ('04fccfae059b11e8ba04080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '太原市', '1', '14', '0', '0');
INSERT INTO `yn_city` VALUES ('04fceba6059b11e8bc0e080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '大同市', '1', '15', '0', '0');
INSERT INTO `yn_city` VALUES ('04fd0bf4059b11e89fbb080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '阳泉市', '1', '16', '0', '0');
INSERT INTO `yn_city` VALUES ('04fd218e059b11e8a39e080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '长治市', '1', '17', '0', '0');
INSERT INTO `yn_city` VALUES ('04fd3890059b11e8ae09080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '晋城市', '1', '18', '0', '0');
INSERT INTO `yn_city` VALUES ('04fd6a5e059b11e8b842080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '朔州市', '1', '19', '0', '0');
INSERT INTO `yn_city` VALUES ('04fd780a059b11e8a22c080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '晋中市', '1', '20', '0', '0');
INSERT INTO `yn_city` VALUES ('04fd8db8059b11e88e28080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '运城市', '1', '21', '0', '0');
INSERT INTO `yn_city` VALUES ('04fdc2d8059b11e889c6080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '忻州市', '1', '22', '0', '0');
INSERT INTO `yn_city` VALUES ('04fddd5e059b11e8b6f5080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '临汾市', '1', '23', '0', '0');
INSERT INTO `yn_city` VALUES ('04fdef38059b11e8b81b080027de0e0e', '7b968f58059911e88bbb080027de0e0e', '吕梁市', '1', '24', '0', '0');
INSERT INTO `yn_city` VALUES ('04fe0356059b11e885a1080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '呼和浩特市', '1', '25', '0', '0');
INSERT INTO `yn_city` VALUES ('04fe1d14059b11e88191080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '包头市', '1', '26', '0', '0');
INSERT INTO `yn_city` VALUES ('04fe4e9c059b11e8811b080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '乌海市', '1', '27', '0', '0');
INSERT INTO `yn_city` VALUES ('04fe6f8a059b11e8b5da080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '赤峰市', '1', '28', '0', '0');
INSERT INTO `yn_city` VALUES ('04fe8330059b11e8b41c080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '通辽市', '1', '29', '0', '0');
INSERT INTO `yn_city` VALUES ('04fecb92059b11e8a34b080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '鄂尔多斯市', '1', '30', '0', '0');
INSERT INTO `yn_city` VALUES ('04fef2ac059b11e8ae9b080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '呼伦贝尔市', '1', '31', '0', '0');
INSERT INTO `yn_city` VALUES ('04ff0f76059b11e88128080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '巴彦淖尔市', '1', '32', '0', '0');
INSERT INTO `yn_city` VALUES ('04ff29fc059b11e88a71080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '乌兰察布市', '1', '33', '0', '0');
INSERT INTO `yn_city` VALUES ('04ff4a4a059b11e8a671080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '兴安盟', '1', '34', '0', '0');
INSERT INTO `yn_city` VALUES ('04ff63f4059b11e892f5080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '锡林郭勒盟', '1', '35', '0', '0');
INSERT INTO `yn_city` VALUES ('04ff806e059b11e89e33080027de0e0e', '7b96bbb8059911e8bbd7080027de0e0e', '阿拉善盟', '1', '36', '0', '0');
INSERT INTO `yn_city` VALUES ('04ffacf6059b11e8b8e1080027de0e0e', '7b9710fe059911e88699080027de0e0e', '沈阳市', '1', '37', '0', '0');
INSERT INTO `yn_city` VALUES ('04ffc628059b11e8af9d080027de0e0e', '7b9710fe059911e88699080027de0e0e', '大连市', '1', '38', '0', '0');
INSERT INTO `yn_city` VALUES ('04ffda3c059b11e8a0e5080027de0e0e', '7b9710fe059911e88699080027de0e0e', '鞍山市', '1', '39', '0', '0');
INSERT INTO `yn_city` VALUES ('04fff602059b11e8a9b5080027de0e0e', '7b9710fe059911e88699080027de0e0e', '抚顺市', '1', '40', '0', '0');
INSERT INTO `yn_city` VALUES ('05001e02059b11e89700080027de0e0e', '7b9710fe059911e88699080027de0e0e', '本溪市', '1', '41', '0', '0');
INSERT INTO `yn_city` VALUES ('05003266059b11e8b1e1080027de0e0e', '7b9710fe059911e88699080027de0e0e', '丹东市', '1', '42', '0', '0');
INSERT INTO `yn_city` VALUES ('05004f9e059b11e88af5080027de0e0e', '7b9710fe059911e88699080027de0e0e', '锦州市', '1', '43', '0', '0');
INSERT INTO `yn_city` VALUES ('05006a9c059b11e8a22f080027de0e0e', '7b9710fe059911e88699080027de0e0e', '营口市', '1', '44', '0', '0');
INSERT INTO `yn_city` VALUES ('0500926a059b11e88fe9080027de0e0e', '7b9710fe059911e88699080027de0e0e', '阜新市', '1', '45', '0', '0');
INSERT INTO `yn_city` VALUES ('0500a7c8059b11e88942080027de0e0e', '7b9710fe059911e88699080027de0e0e', '辽阳市', '1', '46', '0', '0');
INSERT INTO `yn_city` VALUES ('0500c37a059b11e88d63080027de0e0e', '7b9710fe059911e88699080027de0e0e', '盘锦市', '1', '47', '0', '0');
INSERT INTO `yn_city` VALUES ('0500fdf4059b11e892bb080027de0e0e', '7b9710fe059911e88699080027de0e0e', '铁岭市', '1', '48', '0', '0');
INSERT INTO `yn_city` VALUES ('0501196a059b11e8a270080027de0e0e', '7b9710fe059911e88699080027de0e0e', '朝阳市', '1', '49', '0', '0');
INSERT INTO `yn_city` VALUES ('0501392c059b11e8a4b6080027de0e0e', '7b9710fe059911e88699080027de0e0e', '葫芦岛市', '1', '50', '0', '0');
INSERT INTO `yn_city` VALUES ('05016b54059b11e88e1e080027de0e0e', '7b974718059911e89d4b080027de0e0e', '长春市', '1', '51', '0', '0');
INSERT INTO `yn_city` VALUES ('050184ea059b11e89784080027de0e0e', '7b974718059911e89d4b080027de0e0e', '吉林市', '1', '52', '0', '0');
INSERT INTO `yn_city` VALUES ('05019e44059b11e88cf4080027de0e0e', '7b974718059911e89d4b080027de0e0e', '四平市', '1', '53', '0', '0');
INSERT INTO `yn_city` VALUES ('0501af60059b11e8b4b8080027de0e0e', '7b974718059911e89d4b080027de0e0e', '辽源市', '1', '54', '0', '0');
INSERT INTO `yn_city` VALUES ('0501ee9e059b11e88868080027de0e0e', '7b974718059911e89d4b080027de0e0e', '通化市', '1', '55', '0', '0');
INSERT INTO `yn_city` VALUES ('05020834059b11e89e0a080027de0e0e', '7b974718059911e89d4b080027de0e0e', '白山市', '1', '56', '0', '0');
INSERT INTO `yn_city` VALUES ('05021e14059b11e8ac14080027de0e0e', '7b974718059911e89d4b080027de0e0e', '松原市', '1', '57', '0', '0');
INSERT INTO `yn_city` VALUES ('05023b38059b11e89554080027de0e0e', '7b974718059911e89d4b080027de0e0e', '白城市', '1', '58', '0', '0');
INSERT INTO `yn_city` VALUES ('05026f40059b11e8a1c0080027de0e0e', '7b974718059911e89d4b080027de0e0e', '延边朝鲜族自治州', '1', '59', '0', '0');
INSERT INTO `yn_city` VALUES ('050288ea059b11e88055080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '哈尔滨市', '1', '60', '0', '0');
INSERT INTO `yn_city` VALUES ('05029f1a059b11e89577080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '齐齐哈尔市', '1', '61', '0', '0');
INSERT INTO `yn_city` VALUES ('0502b720059b11e8b68d080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '鸡西市', '1', '62', '0', '0');
INSERT INTO `yn_city` VALUES ('0502cd1e059b11e88885080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '鹤岗市', '1', '63', '0', '0');
INSERT INTO `yn_city` VALUES ('05030a04059b11e888a7080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '双鸭山市', '1', '64', '0', '0');
INSERT INTO `yn_city` VALUES ('05032b74059b11e892c2080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '大庆市', '1', '65', '0', '0');
INSERT INTO `yn_city` VALUES ('0503487a059b11e88508080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '伊春市', '1', '66', '0', '0');
INSERT INTO `yn_city` VALUES ('05035b62059b11e88ebd080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '佳木斯市', '1', '67', '0', '0');
INSERT INTO `yn_city` VALUES ('05039bf4059b11e88246080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '七台河市', '1', '68', '0', '0');
INSERT INTO `yn_city` VALUES ('0503b3d2059b11e890cd080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '牡丹江市', '1', '69', '0', '0');
INSERT INTO `yn_city` VALUES ('0503c87c059b11e88453080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '黑河市', '1', '70', '0', '0');
INSERT INTO `yn_city` VALUES ('0503f644059b11e8a23d080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '绥化市', '1', '71', '0', '0');
INSERT INTO `yn_city` VALUES ('0504108e059b11e8a66d080027de0e0e', '7b978ea8059911e8bc93080027de0e0e', '大兴安岭地区', '1', '72', '0', '0');
INSERT INTO `yn_city` VALUES ('05042bc8059b11e8901c080027de0e0e', '7b97dd36059911e89183080027de0e0e', '上海市', '1', '73', '0', '0');
INSERT INTO `yn_city` VALUES ('05044658059b11e8b8a7080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '南京市', '1', '74', '0', '0');
INSERT INTO `yn_city` VALUES ('05046070059b11e88a61080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '无锡市', '1', '75', '0', '0');
INSERT INTO `yn_city` VALUES ('05048276059b11e8bb22080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '徐州市', '1', '76', '0', '0');
INSERT INTO `yn_city` VALUES ('05049d38059b11e895cf080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '常州市', '1', '77', '0', '0');
INSERT INTO `yn_city` VALUES ('0504b8ae059b11e8b327080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '苏州市', '1', '78', '0', '0');
INSERT INTO `yn_city` VALUES ('0504d0d2059b11e88a6e080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '南通市', '1', '79', '0', '0');
INSERT INTO `yn_city` VALUES ('0504ea86059b11e8be69080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '连云港市', '1', '80', '0', '0');
INSERT INTO `yn_city` VALUES ('0505055c059b11e8998b080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '淮安市', '1', '81', '0', '0');
INSERT INTO `yn_city` VALUES ('05053478059b11e88c34080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '盐城市', '1', '82', '0', '0');
INSERT INTO `yn_city` VALUES ('05054c88059b11e8beeb080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '扬州市', '1', '83', '0', '0');
INSERT INTO `yn_city` VALUES ('05056768059b11e88026080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '镇江市', '1', '84', '0', '0');
INSERT INTO `yn_city` VALUES ('050581b2059b11e8ab8b080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '泰州市', '1', '85', '0', '0');
INSERT INTO `yn_city` VALUES ('05059a8a059b11e8a447080027de0e0e', '7b982ce6059911e895b3080027de0e0e', '宿迁市', '1', '86', '0', '0');
INSERT INTO `yn_city` VALUES ('0505b43e059b11e8b4c4080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '杭州市', '1', '87', '0', '0');
INSERT INTO `yn_city` VALUES ('0505cf78059b11e8b331080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '宁波市', '1', '88', '0', '0');
INSERT INTO `yn_city` VALUES ('0505e7ce059b11e89dab080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '温州市', '1', '89', '0', '0');
INSERT INTO `yn_city` VALUES ('050603a8059b11e8b7af080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '嘉兴市', '1', '90', '0', '0');
INSERT INTO `yn_city` VALUES ('050621a8059b11e8a51e080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '湖州市', '1', '91', '0', '0');
INSERT INTO `yn_city` VALUES ('05063ee0059b11e8b152080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '绍兴市', '1', '92', '0', '0');
INSERT INTO `yn_city` VALUES ('05067ee6059b11e89155080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '金华市', '1', '93', '0', '0');
INSERT INTO `yn_city` VALUES ('05069fc0059b11e8bd13080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '衢州市', '1', '94', '0', '0');
INSERT INTO `yn_city` VALUES ('0506b9d8059b11e8bca4080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '舟山市', '1', '95', '0', '0');
INSERT INTO `yn_city` VALUES ('0506e1e2059b11e8b0aa080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '台州市', '1', '96', '0', '0');
INSERT INTO `yn_city` VALUES ('0506fda8059b11e8b110080027de0e0e', 'ed1e39aa059911e8b501080027de0e0e', '丽水市', '1', '97', '0', '0');
INSERT INTO `yn_city` VALUES ('05070f8c059b11e8beaa080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '合肥市', '1', '98', '0', '0');
INSERT INTO `yn_city` VALUES ('050753d4059b11e8abea080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '芜湖市', '1', '99', '0', '0');
INSERT INTO `yn_city` VALUES ('05076fc2059b11e89c53080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '蚌埠市', '1', '100', '0', '0');
INSERT INTO `yn_city` VALUES ('05078962059b11e89555080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '淮南市', '1', '101', '0', '0');
INSERT INTO `yn_city` VALUES ('0507a578059b11e88035080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '马鞍山市', '1', '102', '0', '0');
INSERT INTO `yn_city` VALUES ('0507c724059b11e89e6f080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '淮北市', '1', '103', '0', '0');
INSERT INTO `yn_city` VALUES ('0507e448059b11e893fa080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '铜陵市', '1', '104', '0', '0');
INSERT INTO `yn_city` VALUES ('0507fa14059b11e8865a080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '安庆市', '1', '105', '0', '0');
INSERT INTO `yn_city` VALUES ('05082d0e059b11e8a81d080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '黄山市', '1', '106', '0', '0');
INSERT INTO `yn_city` VALUES ('0508410e059b11e8bf3c080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '滁州市', '1', '107', '0', '0');
INSERT INTO `yn_city` VALUES ('05085c2a059b11e8a685080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '阜阳市', '1', '108', '0', '0');
INSERT INTO `yn_city` VALUES ('05088e98059b11e8b334080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '宿州市', '1', '109', '0', '0');
INSERT INTO `yn_city` VALUES ('0508aa22059b11e89f7d080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '巢湖市', '1', '110', '0', '0');
INSERT INTO `yn_city` VALUES ('0508bf30059b11e8bbfc080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '六安市', '1', '111', '0', '0');
INSERT INTO `yn_city` VALUES ('0508e870059b11e8b3db080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '亳州市', '1', '112', '0', '0');
INSERT INTO `yn_city` VALUES ('05090a8a059b11e89336080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '池州市', '1', '113', '0', '0');
INSERT INTO `yn_city` VALUES ('05092358059b11e88224080027de0e0e', 'ed1ee9cc059911e8b36b080027de0e0e', '宣城市', '1', '114', '0', '0');
INSERT INTO `yn_city` VALUES ('050939ec059b11e89154080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '福州市', '1', '115', '0', '0');
INSERT INTO `yn_city` VALUES ('05094ea0059b11e883e5080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '厦门市', '1', '116', '0', '0');
INSERT INTO `yn_city` VALUES ('05096854059b11e882b6080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '莆田市', '1', '117', '0', '0');
INSERT INTO `yn_city` VALUES ('05099e46059b11e89cf1080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '三明市', '1', '118', '0', '0');
INSERT INTO `yn_city` VALUES ('0509acba059b11e8b131080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '泉州市', '1', '119', '0', '0');
INSERT INTO `yn_city` VALUES ('0509c984059b11e88f15080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '漳州市', '1', '120', '0', '0');
INSERT INTO `yn_city` VALUES ('0509e392059b11e88fdf080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '南平市', '1', '121', '0', '0');
INSERT INTO `yn_city` VALUES ('0509fe54059b11e8936b080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '龙岩市', '1', '122', '0', '0');
INSERT INTO `yn_city` VALUES ('050a22b2059b11e89ccc080027de0e0e', 'ed1f3c42059911e8a3f7080027de0e0e', '宁德市', '1', '123', '0', '0');
INSERT INTO `yn_city` VALUES ('050a3c5c059b11e89e2d080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '南昌市', '1', '124', '0', '0');
INSERT INTO `yn_city` VALUES ('050a5b38059b11e8b03d080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '景德镇市', '1', '125', '0', '0');
INSERT INTO `yn_city` VALUES ('050a85f4059b11e8bdae080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '萍乡市', '1', '126', '0', '0');
INSERT INTO `yn_city` VALUES ('050a9f44059b11e88a53080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '九江市', '1', '127', '0', '0');
INSERT INTO `yn_city` VALUES ('050ab8f8059b11e8bdca080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '新余市', '1', '128', '0', '0');
INSERT INTO `yn_city` VALUES ('050ad342059b11e881f5080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '鹰潭市', '1', '129', '0', '0');
INSERT INTO `yn_city` VALUES ('050aebfc059b11e8bf6d080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '赣州市', '1', '130', '0', '0');
INSERT INTO `yn_city` VALUES ('050b05d8059b11e8aa5a080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '吉安市', '1', '131', '0', '0');
INSERT INTO `yn_city` VALUES ('050b22ac059b11e89bb8080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '宜春市', '1', '132', '0', '0');
INSERT INTO `yn_city` VALUES ('050b4408059b11e8bebd080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '抚州市', '1', '133', '0', '0');
INSERT INTO `yn_city` VALUES ('050b62e4059b11e882a0080027de0e0e', 'ed1f996c059911e8b875080027de0e0e', '上饶市', '1', '134', '0', '0');
INSERT INTO `yn_city` VALUES ('050b9354059b11e8b205080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '济南市', '1', '135', '0', '0');
INSERT INTO `yn_city` VALUES ('050bae02059b11e8b9bd080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '青岛市', '1', '136', '0', '0');
INSERT INTO `yn_city` VALUES ('050bcd10059b11e8b707080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '淄博市', '1', '137', '0', '0');
INSERT INTO `yn_city` VALUES ('050be656059b11e8a3a6080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '枣庄市', '1', '138', '0', '0');
INSERT INTO `yn_city` VALUES ('050c017c059b11e8a914080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '东营市', '1', '139', '0', '0');
INSERT INTO `yn_city` VALUES ('050c1c52059b11e89d82080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '烟台市', '1', '140', '0', '0');
INSERT INTO `yn_city` VALUES ('050c376e059b11e8bbbb080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '潍坊市', '1', '141', '0', '0');
INSERT INTO `yn_city` VALUES ('050c4fba059b11e8a29d080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '济宁市', '1', '142', '0', '0');
INSERT INTO `yn_city` VALUES ('050c6b76059b11e8a7c5080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '泰安市', '1', '143', '0', '0');
INSERT INTO `yn_city` VALUES ('050c8570059b11e88f45080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '威海市', '1', '144', '0', '0');
INSERT INTO `yn_city` VALUES ('050c9f7e059b11e89140080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '日照市', '1', '145', '0', '0');
INSERT INTO `yn_city` VALUES ('050cb900059b11e8a9fa080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '莱芜市', '1', '146', '0', '0');
INSERT INTO `yn_city` VALUES ('050cd71e059b11e8a275080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '临沂市', '1', '147', '0', '0');
INSERT INTO `yn_city` VALUES ('050cf2da059b11e8ba48080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '德州市', '1', '148', '0', '0');
INSERT INTO `yn_city` VALUES ('050d2bba059b11e8ac7a080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '聊城市', '1', '149', '0', '0');
INSERT INTO `yn_city` VALUES ('050d4a82059b11e88f2f080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '滨州市', '1', '150', '0', '0');
INSERT INTO `yn_city` VALUES ('050d6864059b11e8a9d2080027de0e0e', 'ed1fd404059911e88ecb080027de0e0e', '菏泽', '1', '151', '0', '0');
INSERT INTO `yn_city` VALUES ('050d813c059b11e88ec9080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '郑州市', '1', '152', '0', '0');
INSERT INTO `yn_city` VALUES ('050dac84059b11e88845080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '开封市', '1', '153', '0', '0');
INSERT INTO `yn_city` VALUES ('050dc70a059b11e88132080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '洛阳市', '1', '154', '0', '0');
INSERT INTO `yn_city` VALUES ('050e0594059b11e8a20a080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '平顶山市', '1', '155', '0', '0');
INSERT INTO `yn_city` VALUES ('050e1ed0059b11e89372080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '安阳市', '1', '156', '0', '0');
INSERT INTO `yn_city` VALUES ('050e3a32059b11e897ea080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '鹤壁市', '1', '157', '0', '0');
INSERT INTO `yn_city` VALUES ('050e5594059b11e89c41080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '新乡市', '1', '158', '0', '0');
INSERT INTO `yn_city` VALUES ('050e6e8a059b11e8907f080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '焦作市', '1', '159', '0', '0');
INSERT INTO `yn_city` VALUES ('050e8988059b11e8ab28080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '濮阳市', '1', '160', '0', '0');
INSERT INTO `yn_city` VALUES ('050ea512059b11e8b001080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '许昌市', '1', '161', '0', '0');
INSERT INTO `yn_city` VALUES ('050ebf34059b11e8b650080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '漯河市', '1', '162', '0', '0');
INSERT INTO `yn_city` VALUES ('050eced4059b11e894f6080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '三门峡市', '1', '163', '0', '0');
INSERT INTO `yn_city` VALUES ('050efb0c059b11e89933080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '南阳市', '1', '164', '0', '0');
INSERT INTO `yn_city` VALUES ('050f1fd8059b11e8bf2d080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '商丘市', '1', '165', '0', '0');
INSERT INTO `yn_city` VALUES ('050f3ee6059b11e89353080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '信阳市', '1', '166', '0', '0');
INSERT INTO `yn_city` VALUES ('050f5bec059b11e8982a080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '周口市', '1', '167', '0', '0');
INSERT INTO `yn_city` VALUES ('050f6aba059b11e8a838080027de0e0e', 'ed200b72059911e89c1f080027de0e0e', '驻马店市', '1', '168', '0', '0');
INSERT INTO `yn_city` VALUES ('050f922e059b11e88f13080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '武汉市', '1', '169', '0', '0');
INSERT INTO `yn_city` VALUES ('050fb54c059b11e8bf08080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '黄石市', '1', '170', '0', '0');
INSERT INTO `yn_city` VALUES ('050fc636059b11e88d15080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '十堰市', '1', '171', '0', '0');
INSERT INTO `yn_city` VALUES ('050fd734059b11e8a414080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '宜昌市', '1', '172', '0', '0');
INSERT INTO `yn_city` VALUES ('050ffe8a059b11e8a0ad080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '襄樊市', '1', '173', '0', '0');
INSERT INTO `yn_city` VALUES ('05101aa0059b11e88266080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '鄂州市', '1', '174', '0', '0');
INSERT INTO `yn_city` VALUES ('0510372e059b11e8b89a080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '荆门市', '1', '175', '0', '0');
INSERT INTO `yn_city` VALUES ('05107bbc059b11e8b13c080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '孝感市', '1', '176', '0', '0');
INSERT INTO `yn_city` VALUES ('051099a8059b11e89b77080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '荆州市', '1', '177', '0', '0');
INSERT INTO `yn_city` VALUES ('0510b62c059b11e8ae3c080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '黄冈市', '1', '178', '0', '0');
INSERT INTO `yn_city` VALUES ('0510e5b6059b11e8a150080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '咸宁市', '1', '179', '0', '0');
INSERT INTO `yn_city` VALUES ('0510f830059b11e89130080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '随州市', '1', '180', '0', '0');
INSERT INTO `yn_city` VALUES ('05110b4a059b11e8ace4080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '恩施土家族苗族自治州', '1', '181', '0', '0');
INSERT INTO `yn_city` VALUES ('05112c38059b11e89630080027de0e0e', 'ed203886059911e8b4bd080027de0e0e', '神农架', '1', '182', '0', '0');
INSERT INTO `yn_city` VALUES ('05116388059b11e8af04080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '长沙市', '1', '183', '0', '0');
INSERT INTO `yn_city` VALUES ('051180c0059b11e896d1080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '株洲市', '1', '184', '0', '0');
INSERT INTO `yn_city` VALUES ('05119ec0059b11e8ab64080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '湘潭市', '1', '185', '0', '0');
INSERT INTO `yn_city` VALUES ('0511d19c059b11e88a69080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '衡阳市', '1', '186', '0', '0');
INSERT INTO `yn_city` VALUES ('0511e808059b11e8832e080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '邵阳市', '1', '187', '0', '0');
INSERT INTO `yn_city` VALUES ('0511fc62059b11e8a56a080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '岳阳市', '1', '188', '0', '0');
INSERT INTO `yn_city` VALUES ('051218e6059b11e8a958080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '常德市', '1', '189', '0', '0');
INSERT INTO `yn_city` VALUES ('05124b72059b11e8b1e0080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '张家界市', '1', '190', '0', '0');
INSERT INTO `yn_city` VALUES ('05126706059b11e88243080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '益阳市', '1', '191', '0', '0');
INSERT INTO `yn_city` VALUES ('05127886059b11e89ecb080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '郴州市', '1', '192', '0', '0');
INSERT INTO `yn_city` VALUES ('0512915e059b11e89162080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '永州市', '1', '193', '0', '0');
INSERT INTO `yn_city` VALUES ('0512acb6059b11e894b5080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '怀化市', '1', '194', '0', '0');
INSERT INTO `yn_city` VALUES ('0512eb86059b11e8953f080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '娄底市', '1', '195', '0', '0');
INSERT INTO `yn_city` VALUES ('05130954059b11e8a379080027de0e0e', 'ed208f16059911e885b1080027de0e0e', '湘西土家族苗族自治州', '1', '196', '0', '0');
INSERT INTO `yn_city` VALUES ('051324f2059b11e8a6c7080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '广州市', '1', '197', '0', '0');
INSERT INTO `yn_city` VALUES ('05133f6e059b11e8b6bb080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '韶关市', '1', '198', '0', '0');
INSERT INTO `yn_city` VALUES ('05135c56059b11e8abb3080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '深圳市', '1', '199', '0', '0');
INSERT INTO `yn_city` VALUES ('05137600059b11e8b1bf080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '珠海市', '1', '200', '0', '0');
INSERT INTO `yn_city` VALUES ('05139176059b11e89642080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '汕头市', '1', '201', '0', '0');
INSERT INTO `yn_city` VALUES ('0513aaee059b11e8b1e3080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '佛山市', '1', '202', '0', '0');
INSERT INTO `yn_city` VALUES ('0513b804059b11e89d36080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '江门市', '1', '203', '0', '0');
INSERT INTO `yn_city` VALUES ('0513f9ae059b11e8aaae080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '湛江市', '1', '204', '0', '0');
INSERT INTO `yn_city` VALUES ('0514129a059b11e88fed080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '茂名市', '1', '205', '0', '0');
INSERT INTO `yn_city` VALUES ('05144404059b11e8a98d080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '肇庆市', '1', '206', '0', '0');
INSERT INTO `yn_city` VALUES ('05145994059b11e88a0a080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '惠州市', '1', '207', '0', '0');
INSERT INTO `yn_city` VALUES ('051493aa059b11e89990080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '梅州市', '1', '208', '0', '0');
INSERT INTO `yn_city` VALUES ('0514abe2059b11e8a8c2080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '汕尾市', '1', '209', '0', '0');
INSERT INTO `yn_city` VALUES ('0514c514059b11e89221080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '河源市', '1', '210', '0', '0');
INSERT INTO `yn_city` VALUES ('0514de78059b11e893ae080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '阳江市', '1', '211', '0', '0');
INSERT INTO `yn_city` VALUES ('0514ec1a059b11e88c5f080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '清远市', '1', '212', '0', '0');
INSERT INTO `yn_city` VALUES ('05151bcc059b11e8ac1b080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '东莞市', '1', '213', '0', '0');
INSERT INTO `yn_city` VALUES ('051535e4059b11e8be0b080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '中山市', '1', '214', '0', '0');
INSERT INTO `yn_city` VALUES ('051544d0059b11e8a534080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '潮州市', '1', '215', '0', '0');
INSERT INTO `yn_city` VALUES ('0515723e059b11e8835b080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '揭阳市', '1', '216', '0', '0');
INSERT INTO `yn_city` VALUES ('05158de6059b11e8b690080027de0e0e', 'ed20c67a059911e89e0d080027de0e0e', '云浮市', '1', '217', '0', '0');
INSERT INTO `yn_city` VALUES ('0515ca86059b11e89156080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '南宁市', '1', '218', '0', '0');
INSERT INTO `yn_city` VALUES ('0515e796059b11e8827f080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '柳州市', '1', '219', '0', '0');
INSERT INTO `yn_city` VALUES ('0515f9e8059b11e89d33080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '桂林市', '1', '220', '0', '0');
INSERT INTO `yn_city` VALUES ('05160ffa059b11e8b978080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '梧州市', '1', '221', '0', '0');
INSERT INTO `yn_city` VALUES ('051648ee059b11e8b613080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '北海市', '1', '222', '0', '0');
INSERT INTO `yn_city` VALUES ('051660cc059b11e880b7080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '防城港市', '1', '223', '0', '0');
INSERT INTO `yn_city` VALUES ('051698ee059b11e8a474080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '钦州市', '1', '224', '0', '0');
INSERT INTO `yn_city` VALUES ('0516a474059b11e883b5080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '贵港市', '1', '225', '0', '0');
INSERT INTO `yn_city` VALUES ('0516e0ce059b11e883c3080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '玉林市', '1', '226', '0', '0');
INSERT INTO `yn_city` VALUES ('0516f528059b11e8a022080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '百色市', '1', '227', '0', '0');
INSERT INTO `yn_city` VALUES ('05172b24059b11e8bb90080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '贺州市', '1', '228', '0', '0');
INSERT INTO `yn_city` VALUES ('051747d0059b11e8a334080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '河池市', '1', '229', '0', '0');
INSERT INTO `yn_city` VALUES ('05176030059b11e8b00b080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '来宾市', '1', '230', '0', '0');
INSERT INTO `yn_city` VALUES ('05177a34059b11e8b33b080027de0e0e', 'ed211152059911e8a01c080027de0e0e', '崇左市', '1', '231', '0', '0');
INSERT INTO `yn_city` VALUES ('0517ae1e059b11e8a2d9080027de0e0e', 'ed21679c059911e8891b080027de0e0e', '海口市', '1', '232', '0', '0');
INSERT INTO `yn_city` VALUES ('0517c82c059b11e8b951080027de0e0e', 'ed21679c059911e8891b080027de0e0e', '三亚市', '1', '233', '0', '0');
INSERT INTO `yn_city` VALUES ('0517e2da059b11e88e68080027de0e0e', 'ed21c02a059911e8b90b080027de0e0e', '重庆市', '1', '234', '0', '0');
INSERT INTO `yn_city` VALUES ('05180792059b11e8a06e080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '成都市', '1', '235', '0', '0');
INSERT INTO `yn_city` VALUES ('05182452059b11e89df7080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '自贡市', '1', '236', '0', '0');
INSERT INTO `yn_city` VALUES ('05183b04059b11e8803b080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '攀枝花市', '1', '237', '0', '0');
INSERT INTO `yn_city` VALUES ('051853c8059b11e8b278080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '泸州市', '1', '238', '0', '0');
INSERT INTO `yn_city` VALUES ('0518795c059b11e8ba9f080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '德阳市', '1', '239', '0', '0');
INSERT INTO `yn_city` VALUES ('0518a274059b11e896bd080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '绵阳市', '1', '240', '0', '0');
INSERT INTO `yn_city` VALUES ('0518c1fa059b11e8b8a7080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '广元市', '1', '241', '0', '0');
INSERT INTO `yn_city` VALUES ('0518e4fa059b11e8b3e1080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '遂宁市', '1', '242', '0', '0');
INSERT INTO `yn_city` VALUES ('0518fed6059b11e89b44080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '内江市', '1', '243', '0', '0');
INSERT INTO `yn_city` VALUES ('05192a32059b11e8b36b080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '乐山市', '1', '244', '0', '0');
INSERT INTO `yn_city` VALUES ('05194346059b11e884fb080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '南充市', '1', '245', '0', '0');
INSERT INTO `yn_city` VALUES ('05195eb2059b11e89fc2080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '眉山市', '1', '246', '0', '0');
INSERT INTO `yn_city` VALUES ('051975b4059b11e8aaa3080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '宜宾市', '1', '247', '0', '0');
INSERT INTO `yn_city` VALUES ('05198f7c059b11e89948080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '广安市', '1', '248', '0', '0');
INSERT INTO `yn_city` VALUES ('0519b6f0059b11e89657080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '达州市', '1', '249', '0', '0');
INSERT INTO `yn_city` VALUES ('0519d202059b11e8a558080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '雅安市', '1', '250', '0', '0');
INSERT INTO `yn_city` VALUES ('0519ee54059b11e88a4f080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '巴中市', '1', '251', '0', '0');
INSERT INTO `yn_city` VALUES ('051a0736059b11e899ba080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '资阳市', '1', '252', '0', '0');
INSERT INTO `yn_city` VALUES ('051a21e4059b11e89de5080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '阿坝藏族羌族自治州', '1', '253', '0', '0');
INSERT INTO `yn_city` VALUES ('051a3ad0059b11e8809f080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '甘孜藏族自治州', '1', '254', '0', '0');
INSERT INTO `yn_city` VALUES ('051a53d0059b11e8aa1f080027de0e0e', 'ed21f2ac059911e899ff080027de0e0e', '凉山彝族自治州', '1', '255', '0', '0');
INSERT INTO `yn_city` VALUES ('051a6bcc059b11e88114080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '贵阳市', '1', '256', '0', '0');
INSERT INTO `yn_city` VALUES ('051a9052059b11e88b1a080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '六盘水市', '1', '257', '0', '0');
INSERT INTO `yn_city` VALUES ('051ac040059b11e8bc51080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '遵义市', '1', '258', '0', '0');
INSERT INTO `yn_city` VALUES ('051ae35e059b11e8b68e080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '安顺市', '1', '259', '0', '0');
INSERT INTO `yn_city` VALUES ('051b02c6059b11e8864a080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '铜仁地区', '1', '260', '0', '0');
INSERT INTO `yn_city` VALUES ('051b1fa4059b11e8b287080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '黔西南布依族苗族自治州', '1', '261', '0', '0');
INSERT INTO `yn_city` VALUES ('051b2ef4059b11e8ab5e080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '毕节地区', '1', '262', '0', '0');
INSERT INTO `yn_city` VALUES ('051b6626059b11e8b852080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '黔东南苗族侗族自治州', '1', '263', '0', '0');
INSERT INTO `yn_city` VALUES ('051b7c56059b11e889d8080027de0e0e', 'ed2259b8059911e889fd080027de0e0e', '黔南布依族苗族自治州', '1', '264', '0', '0');
INSERT INTO `yn_city` VALUES ('051b8e58059b11e8b9b4080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '昆明市', '1', '265', '0', '0');
INSERT INTO `yn_city` VALUES ('051bbfcc059b11e8bb1a080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '曲靖市', '1', '266', '0', '0');
INSERT INTO `yn_city` VALUES ('051bcd5a059b11e8810b080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '玉溪市', '1', '267', '0', '0');
INSERT INTO `yn_city` VALUES ('051be9a2059b11e8bb54080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '保山市', '1', '268', '0', '0');
INSERT INTO `yn_city` VALUES ('051c0446059b11e88d89080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '昭通市', '1', '269', '0', '0');
INSERT INTO `yn_city` VALUES ('051c2304059b11e89bbc080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '丽江市', '1', '270', '0', '0');
INSERT INTO `yn_city` VALUES ('051c3d08059b11e883ed080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '思茅市', '1', '271', '0', '0');
INSERT INTO `yn_city` VALUES ('051c5798059b11e8bb61080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '临沧市', '1', '272', '0', '0');
INSERT INTO `yn_city` VALUES ('051c7142059b11e8a473080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '楚雄彝族自治州', '1', '273', '0', '0');
INSERT INTO `yn_city` VALUES ('051c8d3a059b11e8a4d9080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '红河哈尼族彝族自治州', '1', '274', '0', '0');
INSERT INTO `yn_city` VALUES ('051ca6f8059b11e8a3ab080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '文山壮族苗族自治州', '1', '275', '0', '0');
INSERT INTO `yn_city` VALUES ('051cc052059b11e8a122080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '西双版纳傣族自治州', '1', '276', '0', '0');
INSERT INTO `yn_city` VALUES ('051cda60059b11e88cd4080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '大理白族自治州', '1', '277', '0', '0');
INSERT INTO `yn_city` VALUES ('051cfaa4059b11e89d2b080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '德宏傣族景颇族自治州', '1', '278', '0', '0');
INSERT INTO `yn_city` VALUES ('051d1638059b11e8a8b7080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '怒江傈僳族自治州', '1', '279', '0', '0');
INSERT INTO `yn_city` VALUES ('051d5526059b11e890b8080027de0e0e', 'ed22a418059911e8a052080027de0e0e', '迪庆藏族自治州', '1', '280', '0', '0');
INSERT INTO `yn_city` VALUES ('051d6d04059b11e8b768080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '拉萨市', '1', '281', '0', '0');
INSERT INTO `yn_city` VALUES ('051d86f4059b11e895b7080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '昌都地区', '1', '282', '0', '0');
INSERT INTO `yn_city` VALUES ('051d9798059b11e8a651080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '山南地区', '1', '283', '0', '0');
INSERT INTO `yn_city` VALUES ('051dbdd6059b11e88a77080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '日喀则地区', '1', '284', '0', '0');
INSERT INTO `yn_city` VALUES ('051de8ba059b11e89308080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '那曲地区', '1', '285', '0', '0');
INSERT INTO `yn_city` VALUES ('051e044e059b11e8bf0c080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '阿里地区', '1', '286', '0', '0');
INSERT INTO `yn_city` VALUES ('051e33d8059b11e8bad9080027de0e0e', 'ed23053e059911e8b374080027de0e0e', '林芝地区', '1', '287', '0', '0');
INSERT INTO `yn_city` VALUES ('051e4de6059b11e8a361080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '西安市', '1', '288', '0', '0');
INSERT INTO `yn_city` VALUES ('051e69ac059b11e89553080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '铜川市', '1', '289', '0', '0');
INSERT INTO `yn_city` VALUES ('051e8644059b11e88d1f080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '宝鸡市', '1', '290', '0', '0');
INSERT INTO `yn_city` VALUES ('051ea05c059b11e8981d080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '咸阳市', '1', '291', '0', '0');
INSERT INTO `yn_city` VALUES ('051eba42059b11e89638080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '渭南市', '1', '292', '0', '0');
INSERT INTO `yn_city` VALUES ('051ed43c059b11e882d5080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '延安市', '1', '293', '0', '0');
INSERT INTO `yn_city` VALUES ('051eefe4059b11e89970080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '汉中市', '1', '294', '0', '0');
INSERT INTO `yn_city` VALUES ('051f1d2a059b11e88d25080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '榆林市', '1', '295', '0', '0');
INSERT INTO `yn_city` VALUES ('051f36fc059b11e8bb5f080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '安康市', '1', '296', '0', '0');
INSERT INTO `yn_city` VALUES ('051f52b8059b11e896fc080027de0e0e', 'ed237456059911e8a1a9080027de0e0e', '商洛市', '1', '297', '0', '0');
INSERT INTO `yn_city` VALUES ('051f7338059b11e8b180080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '兰州市', '1', '298', '0', '0');
INSERT INTO `yn_city` VALUES ('051f91d8059b11e8b386080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '嘉峪关市', '1', '299', '0', '0');
INSERT INTO `yn_city` VALUES ('051fc8f6059b11e8a4f9080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '金昌市', '1', '300', '0', '0');
INSERT INTO `yn_city` VALUES ('051ff81c059b11e8a73c080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '白银市', '1', '301', '0', '0');
INSERT INTO `yn_city` VALUES ('0520116c059b11e8b706080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '天水市', '1', '302', '0', '0');
INSERT INTO `yn_city` VALUES ('05204a10059b11e8b88a080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '武威市', '1', '303', '0', '0');
INSERT INTO `yn_city` VALUES ('052060ea059b11e8a576080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '张掖市', '1', '304', '0', '0');
INSERT INTO `yn_city` VALUES ('05207896059b11e88c5f080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '平凉市', '1', '305', '0', '0');
INSERT INTO `yn_city` VALUES ('052093da059b11e8a56a080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '酒泉市', '1', '306', '0', '0');
INSERT INTO `yn_city` VALUES ('0520cd00059b11e8aeb4080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '庆阳市', '1', '307', '0', '0');
INSERT INTO `yn_city` VALUES ('0520deb2059b11e8bcf0080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '定西市', '1', '308', '0', '0');
INSERT INTO `yn_city` VALUES ('05211602059b11e8ab95080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '陇南市', '1', '309', '0', '0');
INSERT INTO `yn_city` VALUES ('05213042059b11e8a1b7080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '临夏回族自治州', '1', '310', '0', '0');
INSERT INTO `yn_city` VALUES ('0521455a059b11e8a482080027de0e0e', 'ed23b934059911e8a1ae080027de0e0e', '甘南藏族自治州', '1', '311', '0', '0');
INSERT INTO `yn_city` VALUES ('05215a18059b11e8abad080027de0e0e', 'ed23f674059911e89129080027de0e0e', '西宁市', '1', '312', '0', '0');
INSERT INTO `yn_city` VALUES ('05218ca4059b11e89b2c080027de0e0e', 'ed23f674059911e89129080027de0e0e', '海东地区', '1', '313', '0', '0');
INSERT INTO `yn_city` VALUES ('05219ad2059b11e8800c080027de0e0e', 'ed23f674059911e89129080027de0e0e', '海北藏族自治州', '1', '314', '0', '0');
INSERT INTO `yn_city` VALUES ('0521c796059b11e89aaa080027de0e0e', 'ed23f674059911e89129080027de0e0e', '黄南藏族自治州', '1', '315', '0', '0');
INSERT INTO `yn_city` VALUES ('0521e29e059b11e88d38080027de0e0e', 'ed23f674059911e89129080027de0e0e', '海南藏族自治州', '1', '316', '0', '0');
INSERT INTO `yn_city` VALUES ('0521f11c059b11e8b229080027de0e0e', 'ed23f674059911e89129080027de0e0e', '果洛藏族自治州', '1', '317', '0', '0');
INSERT INTO `yn_city` VALUES ('052229f2059b11e8befb080027de0e0e', 'ed23f674059911e89129080027de0e0e', '玉树藏族自治州', '1', '318', '0', '0');
INSERT INTO `yn_city` VALUES ('05224b62059b11e8a00e080027de0e0e', 'ed23f674059911e89129080027de0e0e', '海西蒙古族藏族自治州', '1', '319', '0', '0');
INSERT INTO `yn_city` VALUES ('05226534059b11e891a9080027de0e0e', 'ed243792059911e8ba0e080027de0e0e', '银川市', '1', '320', '0', '0');
INSERT INTO `yn_city` VALUES ('05229d7e059b11e89f89080027de0e0e', 'ed243792059911e8ba0e080027de0e0e', '石嘴山市', '1', '321', '0', '0');
INSERT INTO `yn_city` VALUES ('0522c38a059b11e8b080080027de0e0e', 'ed243792059911e8ba0e080027de0e0e', '吴忠市', '1', '322', '0', '0');
INSERT INTO `yn_city` VALUES ('0522dff0059b11e8acbc080027de0e0e', 'ed243792059911e8ba0e080027de0e0e', '固原市', '1', '323', '0', '0');
INSERT INTO `yn_city` VALUES ('0522f986059b11e891ab080027de0e0e', 'ed243792059911e8ba0e080027de0e0e', '中卫市', '1', '324', '0', '0');
INSERT INTO `yn_city` VALUES ('05230e6c059b11e88495080027de0e0e', 'ed249516059911e89e15080027de0e0e', '乌鲁木齐市', '1', '325', '0', '0');
INSERT INTO `yn_city` VALUES ('052328b6059b11e8979b080027de0e0e', 'ed249516059911e89e15080027de0e0e', '克拉玛依市', '1', '326', '0', '0');
INSERT INTO `yn_city` VALUES ('05236182059b11e8a901080027de0e0e', 'ed249516059911e89e15080027de0e0e', '吐鲁番地区', '1', '327', '0', '0');
INSERT INTO `yn_city` VALUES ('05237c30059b11e88fa6080027de0e0e', 'ed249516059911e89e15080027de0e0e', '哈密地区', '1', '328', '0', '0');
INSERT INTO `yn_city` VALUES ('05238ec8059b11e883ed080027de0e0e', 'ed249516059911e89e15080027de0e0e', '昌吉回族自治州', '1', '329', '0', '0');
INSERT INTO `yn_city` VALUES ('0523a6ec059b11e89cc6080027de0e0e', 'ed249516059911e89e15080027de0e0e', '博尔塔拉蒙古自治州', '1', '330', '0', '0');
INSERT INTO `yn_city` VALUES ('0523bcb8059b11e8a969080027de0e0e', 'ed249516059911e89e15080027de0e0e', '巴音郭楞蒙古自治州', '1', '331', '0', '0');
INSERT INTO `yn_city` VALUES ('0523d680059b11e89a0f080027de0e0e', 'ed249516059911e89e15080027de0e0e', '阿克苏地区', '1', '332', '0', '0');
INSERT INTO `yn_city` VALUES ('05240858059b11e890a0080027de0e0e', 'ed249516059911e89e15080027de0e0e', '克孜勒苏柯尔克孜自治州', '1', '333', '0', '0');
INSERT INTO `yn_city` VALUES ('05242248059b11e8bd7a080027de0e0e', 'ed249516059911e89e15080027de0e0e', '喀什地区', '1', '334', '0', '0');
INSERT INTO `yn_city` VALUES ('05243c1a059b11e89b92080027de0e0e', 'ed249516059911e89e15080027de0e0e', '和田地区', '1', '335', '0', '0');
INSERT INTO `yn_city` VALUES ('05245c36059b11e89900080027de0e0e', 'ed249516059911e89e15080027de0e0e', '伊犁哈萨克自治州', '1', '336', '0', '0');
INSERT INTO `yn_city` VALUES ('052475ea059b11e89505080027de0e0e', 'ed249516059911e89e15080027de0e0e', '塔城地区', '1', '337', '0', '0');
INSERT INTO `yn_city` VALUES ('05249318059b11e898e7080027de0e0e', 'ed249516059911e89e15080027de0e0e', '阿勒泰地区', '1', '338', '0', '0');
INSERT INTO `yn_city` VALUES ('0524bdde059b11e88e2c080027de0e0e', 'ed249516059911e89e15080027de0e0e', '石河子市', '1', '339', '0', '0');
INSERT INTO `yn_city` VALUES ('0524d4e0059b11e8abdf080027de0e0e', 'ed249516059911e89e15080027de0e0e', '阿拉尔市', '1', '340', '0', '0');
INSERT INTO `yn_city` VALUES ('052505a0059b11e897f6080027de0e0e', 'ed249516059911e89e15080027de0e0e', '图木舒克市', '1', '341', '0', '0');
INSERT INTO `yn_city` VALUES ('05252df0059b11e8b27d080027de0e0e', 'ed249516059911e89e15080027de0e0e', '五家渠市', '1', '342', '0', '0');
INSERT INTO `yn_city` VALUES ('05254f2e059b11e8b487080027de0e0e', 'ed24f204059911e8b955080027de0e0e', '香港特别行政区', '1', '343', '0', '0');
INSERT INTO `yn_city` VALUES ('0525765c059b11e8a089080027de0e0e', 'ed25323c059911e8a740080027de0e0e', '澳门特别行政区', '1', '344', '0', '0');
INSERT INTO `yn_city` VALUES ('05259768059b11e89f27080027de0e0e', 'ed256f04059911e8a0a2080027de0e0e', '台湾', '1', '345', '0', '0');
UNLOCK TABLES;

/*计算两点之间的经纬度*/
DROP FUNCTION calc_distance;

CREATE FUNCTION calc_distance(lng1 float(15,6),lat1 float(15,6),lng2 float(15,6),lat2 float(15,6))
RETURNS DOUBLE(10,2)
READS SQL DATA
BEGIN
  DECLARE return_val DOUBLE(10,2) DEFAULT 0.0;
  SET return_val = round(6378.138*2*asin(sqrt(pow(sin( (lat1*pi()/180-lat2*pi()/180)/2),2)+cos(lat1*pi()/180)*cos(lat2*pi()/180)* pow(sin( (lng1*pi()/180-lng2*pi()/180)/2),2)))*1000);
  RETURN return_val;
END