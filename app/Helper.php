<?php

namespace Novus\App;
abstract class Helper
{
  static function prettyVarExport($data)
  {
    highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    echo "<br/>";
  }
}