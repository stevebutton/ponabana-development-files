**1.9.3**
* **Fix** Handled dependency from SitePress::get_setting()
* **Fix** Changed vn to vi in locale files
* **Fix** Updated translations
* **Fix** Replace hardcoded references of 'wpml-translation-management' with WPML_TM_FOLDER

**1.9.2**
* **Performances** Reduced the number of calls to *$sitepress->get_current_language()*, *$this->get_active_languages()* and *$this->get_default_language()*, to avoid running the same queries more times than needed
* **Feature** Added WPML capabilities (see online documentation)
* **Fix** Improved SSL support for CSS and JavaScript files