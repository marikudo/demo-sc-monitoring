<?php
if(!defined('SYSLIBS')) exit ('No direct access allowed');

require "system/core/config/config.php";
require "system/core/autoloader/autoloader.php";
require "system/core/controller/crackerjack.php";
require "system/core/model/crackerjack_model.php";
require "system/core/request/request.php";
require "system/core/registry/registry.php";
require "system/core/router/router.php";
router::route(new request);