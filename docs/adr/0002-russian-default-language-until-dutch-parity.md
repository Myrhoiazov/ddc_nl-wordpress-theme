# Russian stays the Default Language until Dutch reaches its Launch Baseline

Talent Center DDC is legally Dutch, which would normally argue for Dutch as the Default Language, but 100% of existing content is Russian when this work starts. We decided Russian keeps the Default Language role (served at the root URL, no prefix) until Dutch content reaches its Launch Baseline, at which point the Default Language switches to Dutch. Launching with Dutch as default before any Dutch content exists would put an empty or broken experience at the site's most-trafficked URL; Russian accurately reflects the site's actual state today.

**Consequences**: canonical URLs and search engine indexing will need to be re-pointed when the Default Language switches from Russian to Dutch later. That switch is a deliberate planned migration — don't revert it back to Russian if it's noticed after the fact without checking this decision first.
