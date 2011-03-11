<?php
/**
 * @package    Firefox 4 Twitter Party
 * @subpackage server
 * @version    v.0.4
 * @author     Andre Torgal <andre@quodis.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php BSD License
 */

/**
 * escape from global scope
 */
function main()
{
	DEFINE('CLIENT', 'script');
	DEFINE('CONTEXT', __FILE__);
	include dirname(__FILE__) . '/../bootstrap.php';

	Debug::setLogMsgFile($config['App']['pathLog'] .'/mosaic-build.msg.log');
	Debug::setLogErrorFile($config['App']['pathLog'] .'/mosaic-build.error.log');
	Debug::setForceLogToFile(TRUE);

	$period = $config['Jobs']['mosaic-build']['period'];

	while (TRUE)
	{
		// start time
		$start = time();

		$numTiles = Mosaic::updateMosaic();

		Debug::logMsg('OK! ... updated mosaic. number of tiles:' . $numTiles);

		// sleep?
		$elapsed = time() - $start;
		$sleep = $period - $elapsed;
		if ($sleep < 1) $sleep = 1;
		sleep($sleep);

		Debug::logMsg('OK! ... took ' . $elapsed . ' seconds, sleeping for ' . $sleep . ' seconds ...');
	}

} // main()


try
{
	main();
}
catch(Exception $e) {
	Debug::logError($e, 'EXCEPTION ' . $e->getMessage());
	Dispatch::now(0, 'EXCEPTION ' . $e->getMessage());
}

?>