<?php
/**
 * px2-include-php-code
 */
namespace tomk79\pickles2\px2_include_php_code;

/**
 * main.php
 */
class main{

	/**
	 * Picklesオブジェクト
	 */
	private $px;

	/**
	 * Starting function
	 * @param object $px Picklesオブジェクト
	 */
	public static function exec( $px ){
		$me = new self( $px );
		$px->bowl()->each( array($me, 'apply') );
	}

	/**
	 * constructor
	 * @param object $px Picklesオブジェクト
	 */
	public function __construct( $px ){
		$this->px = $px;
	}

	/**
	 * apply output filter
	 * @param string $src HTML, CSS, JavaScriptなどの出力コード
	 * @param string $current_path コンテンツのカレントディレクトリパス
	 * @return string 加工後の出力コード
	 */
	public function apply($src, $current_path = null){
		if( is_null($current_path) ){
			$current_path = $this->px->req()->get_request_file_path();
		}

		// SSI命令の解決
		$tmp_src = $src;
		$src = '';
		while(1){
			$tmp_preg_pattern = '/^(.*?)'.preg_quote('<!--?php','/').'\s+(.*?)\s*'.preg_quote('?-->','/').'(.*)$/s';
			if( !preg_match($tmp_preg_pattern, $tmp_src, $tmp_matched) ){
				$src .= $tmp_src;
				break;
			}
			$src .= $tmp_matched[1];
			$php_code = $tmp_matched[2];
			$tmp_src = $tmp_matched[3];

			if( !$this->px->is_publish_tool() ){
				// プレビュー時: eval() 実行する
				ob_start();
				eval( $php_code );
				$src .= ob_get_clean();
			}else{
				// パブリッシュ時: PHPコードとして出力する
				$src .= '<'.'?php '.$php_code.' ?'.'>';
			}
			continue;
		}

		return $src;
	}

}
