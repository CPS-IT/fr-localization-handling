# Fr localization handling

### Requirements

Requires TYPO3 Version 10.4.x to 12.4.x

### Description

TYPO3 it is not consistent with the fallbackType configuration when working in BE.

If you configured TYPO3 fallbackType to free, TYPO3 should enforce this mode when
saving tt_content record in BE.

To solve this inconsistency we have extended TYPO3 localization handling to enforce
TYPO3 fallbackType: "free" when localizing tt_content records in the page or list modules.

Features:

- Rewrites DataHandler calls to `localize` cmd for tt_content records and set the cmd to `copyToLanguage`.
- Respects TsConfig `mod.web_layout.localization` settings. Override ist done only if following TsConfiguration ist set

```typo3_typoscript
mod.web_layout.localization.enableCopy = 1
mod.web_layout.localization.enableTranslate = 0
```
- Override BE routes to take care or redirects after record localization:
  - Ajax route `/record/process`
  - route `/record/commit`

Todo:

Handle localization of tt_content inline records. In the meantime disable the localization options of tt_content records directly in TCA.

```php
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['config']['appearance']['showPossibleLocalizationRecords'] = false;
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['config']['appearance']['showAllLocalizationLink'] = false;
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['config']['appearance']['showSynchronizationLink'] = false;
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['config']['appearance']['enabledControls']['localize'] = false;
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['content_elements']['config']['behaviour']['allowLanguageSynchronization'] = false;
```