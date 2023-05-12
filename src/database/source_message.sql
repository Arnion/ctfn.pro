/*
Navicat MySQL Data Transfer

Source Server         : MySQL Server
Source Server Version : 50505
Source Host           : 148.251.81.84:3306
Source Database       : ctfnpro_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-05-12 16:36:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `source_message`
-- ----------------------------
DROP TABLE IF EXISTS `source_message`;
CREATE TABLE `source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `message` text CHARACTER SET latin1,
  `date_create` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `date_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of source_message
-- ----------------------------
INSERT INTO `source_message` VALUES ('1', 'Menu', 'Login', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('2', 'Menu', 'Signup', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('3', 'Menu', 'Privacy', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('4', 'Menu', 'Terms', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('5', 'Menu', 'Help', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('6', 'Form', 'EmailAddress', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('7', 'Form', 'Password', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('8', 'Form', 'Remember me', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('9', 'Form', 'Forgot password', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('10', 'Form', 'Don\'t have an account', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('11', 'Form', 'Sign in', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('12', 'Form', 'Sign up', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('13', 'Form', 'Register Your Account', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('14', 'Form', 'First Name', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('15', 'Form', 'I Accept', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('16', 'Form', 'Terms And Condition', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('17', 'Form', 'Already have an account', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('18', 'Form', 'Name', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('19', 'Form', 'Register', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('20', 'Menu', 'Home', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('21', 'Menu', 'Logout', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('22', 'Title', 'Privacy', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('23', 'Title', 'Login', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('24', 'Title', 'Terms', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('25', 'Error', 'This email address has already been taken', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('26', 'Error', 'Value is not an email or phone number', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('27', 'Error', 'This phone number has already been taken', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('28', 'Error', 'Required Agree Personal', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('29', 'Email', 'Registration in the service subject', '2023-04-25 22:08:42', '0', null);
INSERT INTO `source_message` VALUES ('30', 'Email', 'Registration in the service message', '2023-04-25 22:20:48', '0', null);
INSERT INTO `source_message` VALUES ('31', 'Frontend', 'Generate password', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('32', 'Frontend', 'Confirm Registration', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('33', 'Error', 'Error Registration', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('34', 'Email', 'Successful registration subject', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('35', 'Email', 'Successful registration message', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('36', 'Error', 'The account registered for this email is not activated', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('37', 'Error', 'Request reactivation', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('38', 'Error', 'There is no user with this email address', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('39', 'Email', 'Password reset subject', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('40', 'Email', 'Password reset message', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('41', 'Frontend', 'Send', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('42', 'Title', 'Password Reset', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('43', 'Error', 'Error Reset Password Email', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('44', 'Frontend', 'Success Reset Password Email', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('45', 'Frontend', 'Info', '2023-04-25 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('46', 'Frontend', 'Show password', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('47', 'Title', 'Password Reset Confirm', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('48', 'Form', 'Password Confirm Form', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('49', 'Form', 'btn Save Passwd', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('50', 'Error', 'Passwords Not Match', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('51', 'Title', 'Confirm Registration', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('52', 'Email', 'Password changed successfully subject', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('53', 'Email', 'Password changed successfully message', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('54', 'Frontend', 'New password saved', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('55', 'Error', 'Error Password Reset', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('56', 'Error', 'Passw Short', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('57', 'Error', 'Passw Weak', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('58', 'Error', 'Ban User', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('59', 'Error', 'Incorrect Passwd Username', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('60', 'Error', 'Value is not an email or phone number', '2023-04-26 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('61', 'Frontend', 'Success Resend Email', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('62', 'Frontend', 'Resend Title', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('63', 'Error', 'Error Resend Email', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('64', 'Error', 'There is no user with this email address', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('65', 'Frontend', 'Help reset password', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('66', 'Frontend', 'Help resend password', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('67', 'Error', 'No Resend Email', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('68', 'Title', 'Resend Verification Email', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('69', 'Menu', 'Fullscreen', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('70', 'Menu', 'Collapse sidebar', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('71', 'Menu', 'Home', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('72', 'Menu', 'Editing', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('73', 'Menu', 'Pages', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('74', 'Menu', 'Translations', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('75', 'Error', '404', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('76', 'Title', 'Control Panel', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('77', 'Warning', 'Control Panel', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('78', 'Title', 'Admin', '2023-04-27 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('79', 'Backend', 'Pages', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('80', 'Backend', 'Page Editor', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('81', 'Backend', 'Page Name', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('82', 'Backend', 'Page_1', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('83', 'Backend', 'Page_2', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('84', 'Backend', 'Page_3', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('85', 'Backend', 'Page_4', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('86', 'Backend', 'btnBack', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('87', 'Backend', 'btnSave', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('88', 'Backend', 'Page', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('89', 'Error', 'ErrorSave', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('90', 'Backend', 'Save Success', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('91', 'Menu', 'Profile View', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('92', 'Menu', 'Profile Edit', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('93', 'Backend', 'Image Upload', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('94', 'Menu', 'View Profile', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('95', 'Frontend', 'Balance', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('96', 'Frontend', 'Wallet', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('97', 'Frontend', 'Error', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('98', 'Frontend', 'MetaMask', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('99', 'Frontend', 'Please Download MetaMask and create your profile and wallet in MetaMask. Please click and check the details', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('100', 'Frontend', 'Edit your profile', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('101', 'Frontend', 'You can set preferred display name, create your branded profile URL and manage other personal settings.', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('102', 'Frontend', 'Edit Form Profile', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('103', 'Frontend', 'Display Name', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('104', 'Frontend', 'Name', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('105', 'Frontend', 'School Name', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('106', 'Frontend', 'Only latin characters', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('107', 'Frontend', 'Bio', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('108', 'Frontend', 'Bio Placeholder', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('109', 'Frontend', 'Website', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('110', 'Frontend', 'We recommend an image of at least 400X400. GIF, PNG, JPEG work too.', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('111', 'Form', 'Update Profile', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('112', 'Frontent', 'Create school token', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('113', 'Frontent', 'Do you want to create a school token? Please click the create token button.', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('114', 'Frontent', 'Create token', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('115', 'Form', 'Image', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('116', 'Form', 'School Logo', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('117', 'Form', 'Change password', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('118', 'Form', 'btn Update Passwd', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('119', 'Error', 'Update Profile Error', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('120', 'Frontend', 'Update Profile Success', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('121', 'Frontend', 'Close', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('122', 'Frontend', 'Save', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('123', 'Error', 'Server Not File', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('124', 'Error', 'Format Incorrect', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('125', 'Error', 'Missing Client', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('126', 'Error', 'Failed to create personal folder in boot directory', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('127', 'Error', 'Failed to save image', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('128', 'Frontend', 'Image uploaded successfully', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('129', 'Error', 'Format Banner Incorrect', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('130', 'Menu', 'Create Certificate', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('131', 'Frontend', 'Create Certificate Success', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('132', 'Frontend', 'Update Certificate Success', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('133', 'Frontend', 'Issuance your certificate', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('134', 'Frontend', 'Surname', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('135', 'Frontend', 'Course', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('136', 'Frontend', 'Number', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('137', 'Frontend', 'User nft address', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('138', 'Frontend', 'User Name', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('139', 'Error', 'Create Certificate Error', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('140', 'Error', 'Update Certificate Error', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('141', 'Form', 'Create Certificate', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('142', 'Menu', 'Certificate View', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('143', 'Menu', 'Certificate Edit', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('144', 'Menu', 'Certificate Issuance', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('145', 'Menu', 'Certificate Create', '2023-05-02 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('146', 'Frontend', 'Successfully passed', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('147', 'Frontend', 'Certificates', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('148', 'Frontend', 'Certificate PNG', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('149', 'Frontend', 'Certificate PDF', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('150', 'Frontend', 'Edit certificate', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('151', 'Frontend', 'Mainnet', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('152', 'Frontend', 'Testnet', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('153', 'Menu', 'Statistics', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('154', 'Menu', 'Yandex Merica', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('155', 'Menu', 'Google Tag Manager', '2023-05-10 13:00:00', '0', null);
INSERT INTO `source_message` VALUES ('156', 'Frontend', 'Certificates not found. Try another address', '2023-05-12 12:00:00', '0', null);
