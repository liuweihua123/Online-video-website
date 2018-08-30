<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'wordpress2');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'root');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'D$=k_ie+6/lmFdWoT?1S(9P&yfGx]&!29[Jv*g7<bm![7POP~Jgpm(Jgj4oj_R(.');
define('SECURE_AUTH_KEY',  'rm[aG#pems;VRay{b.K_asWdPq8nnKc#b`k&XkqMWCO&N=G; dvn_HGQTw!&<&*Y');
define('LOGGED_IN_KEY',    '@bw!v^ePtkXsyvO9H!?sO./ySdoCdK{Aaj,ui*Erg/O4Yvw!l-t$D|#nC^2tDjCd');
define('NONCE_KEY',        '=2P*1>ju=N;4+1k@`/~3KefQJHjc!ITGvQ4Rlhf8*jo>.*;={?Ab$z~Z+:W*Cxod');
define('AUTH_SALT',        'r#[yU$/;;OJad)w0]qm^(HFnz0~5~$7*4H2%}c$!!1k}S=]3aZ#^~P`86ksH}HBK');
define('SECURE_AUTH_SALT', '5KA_zhh V6HTT}v1U7I~*i{usVKC[e;H$}99#WG$g[v?+x_a4,><,;K47=Hx?*}t');
define('LOGGED_IN_SALT',   'b-|@C9i$@ir<uSAK2uV(Ns8)_A&HY<[<}R2Fq_XfFlO,!,kA^Ib<a2{.tmw{ mQ=');
define('NONCE_SALT',       '..QdSV*8cR:yKy4a]Bp;:l.c4%Ybsz9_3$ys~&F~=uq_./B,sghX7cj,Mu+d;t+_');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
