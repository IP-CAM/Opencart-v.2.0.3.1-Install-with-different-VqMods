<?php
// Heading
$_['heading_title_vqmods'] 				= 'AE Pro VQMod Manager';
$_['heading_bcrumb_vqmods'] 			= 'AE Pro VQMod Manager/ %s';

// Text
$_['text_autodetect']       			= 'VQMod appears to be installed at the following path.  Press Save to confirm path and complete installation.';
$_['text_autodetect_fail']  			= 'Unable to detect VQMod installation.  Please download and install the <a href="https://github.com/vqmod/vqmod/releases" target="_blank">latest version</a> or enter the non-standard server installation path.';
$_['text_cachetime']        			= '%s seconds';
$_['text_edit']         				= 'Edit';
$_['text_edit_vqmod']       			= 'Edit: <strong>%s</strong>';
$_['text_delete']           			= 'Delete';
$_['text_delete_selected']  			= 'Delete Selected';
$_['text_download']         			= 'Download';
$_['text_disabled']         			= 'Disabled';
$_['text_enabled']          			= 'Enabled';
$_['text_return']           			= 'Cancel and return';
$_['text_enabled2']         			= '<i class="fa fa-check fa-2x" style="color:green; cursor:pointer;"></i>';
$_['text_disabled2']        			= '<i class="fa fa-times fa-2x" style="color:red; cursor:pointer;"></i>';
$_['text_install']          			= 'Install';
$_['text_attribution']      			= 'Initially Created by rph @ opencarthelp.com; Enhanced & ported to opencart 2.x by SBWD (sbwd4u@gmail.com)';
$_['text_no_results']       			= 'No VQMod scripts were found!';
$_['text_separator']        			= ' &rarr; ';
$_['text_success']          			= 'Success: You have modified VQMod Manager!';
$_['text_unavailable']      			= '&mdash;';
$_['text_uninstall']        			= 'Uninstall';
$_['text_upload']           			= 'Upload';
$_['text_usecache_help']    			= 'useCache is deprecated as of VQMod 2.1.7';
$_['text_vqcache_help']     			= 'Clears contents of the vqcache directory and deletes mods.cache file.  Some system files will always be present even after clearing the cache.';
$_['text_size']             			= 'Size';

// Columns
$_['column_install']       				= 'Install / Uninstall';
$_['column_author']        				= 'Author';
$_['column_delete']        				= 'Delete';
$_['column_action']        				= 'Action';
$_['column_file_name']     				= 'File Name';
$_['column_id']            				= 'Name / Description';
$_['column_status']        				= 'Status';
$_['column_version']       				= 'Version';
$_['column_xml']     	   				= 'XML';
$_['column_vqmver']        				= 'VQMod Version';
$_['column_size']          				= 'Size';

// Entry
$_['entry_attribution']    				= 'Attribution:';
$_['entry_author']         				= 'Author:';
$_['entry_backup']         				= 'Backup VQMod Scripts:';
$_['entry_ext_store']      				= 'Latest Version:';
$_['entry_ext_version']    				= 'Enhanced VQMod Manager Version:';
$_['entry_forum']          				= 'OpenCart Forum Thread:';
$_['entry_license']        				= 'License:';
$_['entry_upload']         				= 'VQMod Script Upload:';
$_['entry_vqcache']        				= 'VQMod Cache:';
$_['entry_vqmod_path']     				= 'VQMod Path:';
$_['entry_website']        				= 'Website:';

// Button
$_['button_backup']        				= 'Backup';
$_['button_cancel']        				= 'Cancel';
$_['button_clear']         				= 'Clear';
$_['button_download_log']  				= 'Download Log';
$_['button_vqcache_dump']  				= 'vqcache Dump';
$_['button_return']        				= '<i class="fa fa-reply"></i> Return';

// VQMod Variable Settings
$_['setting_dir_separator']   			= 'Directory Separator:';
$_['setting_logfolder']       			= 'Log Folder:';
$_['setting_logging']        			= 'Error Logging:';
$_['setting_modcache']        			= 'modCache:';
$_['setting_path_replaces']   			= 'Path Replacements:<br /><span class="help">Changes do not go into effect until the mods.cache file is deleted.</span>';
$_['setting_protected_files'] 			= 'Protected Files:';

// Success
$_['success_clear_vqcache'] 			= 'Success: VQMod cache cleared!';
$_['success_clear_log']     			= 'Success: VQMod error log cleared!';
$_['success_delete']        			= 'Success: VQMod script deleted!';
$_['success_delete_multi']  			= 'Success: VQMod scripts deleted!';
$_['success_install']       			= 'Success: VQMod script installed!';
$_['success_uninstall']     			= 'Success: VQMod script uninstalled!';
$_['success_upload']        			= 'Success: VQMod script uploaded!';
$_['success_loaded']        			= 'Success: VQMod script loaded!';
$_['success_saved']         			= 'Success: VQMod script <strong>%s</strong> has been saved!';
$_['success_modified']      			= 'Success: VQMod script has been modified!';

// Tabs
$_['tab_about']             			= 'About';
$_['tab_editor']       					= 'VQMod Editor';
$_['tab_error_log']         			= 'Error Log';
$_['tab_settings']          			= 'Settings and Maintenance';
$_['tab_scripts']           			= 'VQMod Scripts';

// Version
$_['vqmod_manager_author']  			= 'rph and SBWD';
$_['vqmod_manager_license'] 			= 'Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)';
$_['vqmod_manager_version'] 			= '1.0';

// Text Highlighting
$_['highlight-error']      				= '<span class="highlight-error">%s</span>';

// VQMod Manager Use Errors
$_['error_delete']         				= 'Warning: Unable to delete VQMod script!';
$_['error_delete_multi']   				= 'Warning: Unable to delete VQMod scripts!';
$_['error_filetype']       				= 'Warning: Invalid filetype!  Please only upload .xml files.';
$_['error_install']        				= 'Warning: Unable to install VQMod script!';
$_['error_invalid_xml']    				= 'Warning: VQMod script XML syntax is invalid!  Please contact the author for support.';
$_['error_log_size']       				= 'Warning: Your VQMod error log is %sMBs.  The limit for VQMod Manager is 6MB.  You can download the error log by FTP or by clicking the \'Download Log\' button in the Error Log tab.  Otherwise consider clearing it.';
$_['error_log_download']   				= 'Warning: No error logs available for download!';
$_['error_moddedfile']     				= 'Warning: VQMod script attempts to mod file \'%s\' which does not appear to exist!';
$_['error_move']           				= 'Warning: Unable to save file on server.  Please check directory permissions.';
$_['error_permission']     				= 'Warning: You do not have permission to modify VQMod Manager!';
$_['error_uninstall']      				= 'Warning: Unable to uninstall VQMod script!';
$_['error_vqmod_opencart'] 				= 'Warning: \'vqmod_opencart.xml\' is rquired for VQMod to function properly!';

// $_FILE Upload Errors
$_['error_form_max_file_size']   		= 'Warning: VQMod script exceeds max allowable size!';
$_['error_ini_max_file_size']    		= 'Warning: VQMod script exceeds max php.ini file size!';
$_['error_no_temp_dir']          		= 'Warning: No temporary directory found!';
$_['error_no_upload']            		= 'Warning: No file selected for upload!';
$_['error_partial_upload']       		= 'Warning: Upload incomplete!';
$_['error_php_conflict']         		= 'Warning: Unknown PHP conflict!';
$_['error_unknown']              		= 'Warning: Unknown error!';
$_['error_write_fail']           		= 'Warning: Failed to write VQMod script!';

// VQMod Installation Errors
$_['error_error_log_write']            	= 'Unable to write to VQMod error log!  Please set "<span class="error-install">/vqmod</span>" directory permissions to 755 or 777 and try again.';
$_['error_error_logs_write']           	= 'Unable to write to VQMod error log!  Please set "<span class="error-install">/vqmod/logs</span>" directory permissions to 755 or 777 and try again.';
$_['error_opencart_version']           	= 'OpenCart 2.x or later is required to use Enhanced VQMod Manager!';
$_['error_opencart_xml']               	= 'Required file "<span class="error-install">/vqmod/xml/vqmod_opencart.xml</span>" does not appear to exist!  Please install the latest OpenCart-compatible version of VQMod from <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a> and try again.';
$_['error_opencart_xml_disabled']      	= 'Warning: "<span class="error-install">vqmod_opencart.xml</span>" is disabled!  VQMod scripts will not function!';
$_['error_opencart_xml_version']       	= 'You appear to be using a version of "<span class="error-install">vqmod_opencart.xml</span>" that is out-of-date for your OpenCart version!  Please install the latest OpenCart-compatible version of VQMod from <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a> and try again.';
$_['error_vqcache_dir']                	= 'Required directory "<span class="error-install">/vqmod/vqcache</span>" does not appear to exist!  Please install the latest OpenCart-compatible version of VQMod from <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a> and try again.';
$_['error_vqcache_write']              	= 'Unable to write to "<span class="error-install">/vqmod/vqcache</span>" directory!  Set permissions to 755 or 777 and try again.';
$_['error_vqcache_files_missing']      	= 'VQMod does not appear to be properly generating vqcache files!';
$_['error_vqmod_core']                 	= 'Required file "<span class="error-install">vqmod.php</span>" is missing!  Please install the latest OpenCart-compatible version of VQMod from <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a> and try again.';
$_['error_vqmod_dir']                  	= 'The "<span class="error-install">/vqmod</span>" directory does not appear to exist!';
$_['error_vqmod_install_link']         	= 'VQMod does not appear to have been integrated with OpenCart!  Please run the VQMod installer at <a href="%1$s">%1$s</a>.  If you have previously run the installer ensure that you are using the latest version of VQMod found at <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a>.';
$_['error_vqmod_opencart_integration'] 	= 'VQMod does not appear to have been integrated with OpenCart!  Please install the latest OpenCart-compatible version of VQMod from <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a> and try again.';
$_['error_vqmod_script_dir']           	= 'Required directory "<span class="error-install">/vqmod/xml</span>" does not appear to exist!  Please install the latest OpenCart-compatible version of VQMod from <a href="https://github.com/vqmod/vqmod/releases" target="_blank">https://github.com/vqmod/vqmod/releases</a> and try again.';
$_['error_vqmod_script_write']         	= 'Unable to write to "<span class="error-install">/vqmod/xml</span>" directory!  Please set directory permissions to 755 or 777 and try again.';

// VQMod Manager Dependency Errors
$_['error_simplexml']       			= '<a href="http://php.net/manual/en/book.simplexml.php" target="_blank">SimpleXML</a> must be installed for VQMod Manager to work properly!  Contact your host for more info.';
$_['error_ziparchive']      			= '<a href="http://php.net/manual/en/class.ziparchive.php" target="_blank">ZipArchive</a> must be installed to download VQMod script files!  Contact your host for more info.';

// VQMod Log Errors
$_['error_mod_aborted']     			= 'Mod Aborted';
$_['error_mod_skipped']     			= 'Operation Skipped';

// Javascript Warnings
$_['warning_required_delete']    		= 'WARNING: Deleting \\\'vqmod_opencart.xml\\\' will cause VQMod to STOP WORKING!  Continue?';
$_['warning_required_uninstall'] 		= 'WARNING: Uninstalling \\\'vqmod_opencart.xml\\\' will cause VQMod to STOP WORKING!  Continue?';
$_['warning_vqmod_delete']       		= 'WARNING: Deleting a VQMod script cannot be undone!  Are you sure you want to do this?';
?>
