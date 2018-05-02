<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Pluswerk.Simpleblog',
            'Bloglisting',
            [
                'Blog' => 'list,addForm,add,show,updateForm,update,deleteConfirm,delete,rss',
                'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
            ],
            // non-cacheable actions
            [
                'Blog' => 'list,addForm,add,show,updateForm,update,deleteConfirm,delete,rss',
                'Post' => 'addForm,add,show,updateForm,update,deleteConfirm,delete,ajax',
            ]
        );

	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					bloglisting {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_bloglisting.svg
						title = LLL:EXT:simpleblog/Resources/Private/Language/locallang_db.xlf:tx_simpleblog_domain_model_bloglisting
						description = LLL:EXT:simpleblog/Resources/Private/Language/locallang_db.xlf:tx_simpleblog_domain_model_bloglisting.description
						tt_content_defValues {
							CType = list
							list_type = simpleblog_bloglisting
						}
					}
				}
				show = *
			}
	   }'
	);
    },
    $_EXTKEY
);
