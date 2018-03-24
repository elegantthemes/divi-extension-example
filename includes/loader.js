// External Dependencies
import $ from 'jquery';

// Internal Dependencies
import CustomCtaFull from './modules/CustomCtaFull/CustomCtaFull';
import CustomCtaAllOptions from './modules/CustomCtaAllOptions/CustomCtaAllOptions';
import CustomCtaParent from './modules/CustomCtaParent/CustomCtaParent';
import CustomCtaChild from './modules/CustomCtaChild/CustomCtaChild';

$(window).on('et_builder_api_ready', (event, API) => {
  API.registerModule('dicm_cta_vb', CustomCtaFull);
  API.registerModule('dicm_cta_all_options', CustomCtaAllOptions);
  API.registerModule('dicm_cta_parent', CustomCtaParent);
  API.registerModule('dicm_cta_child', CustomCtaChild);
});
