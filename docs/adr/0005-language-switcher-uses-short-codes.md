# Language switcher labels use short codes, not full autonyms

ADR 0004 chose text autonyms (Nederlands / Русский / Українська / English) over flag icons for the language switcher. During implementation, we changed the label text itself from full autonyms to short language codes (RU / NL / UK / EN) — a deliberate, explicit decision made when building the header switcher, not an oversight. ADR 0004's actual decision — no national flags next to RU/UK — is unaffected: short codes carry no country symbolism either, so that reasoning still holds without change.

**Considered options**: keep full autonyms as originally specified in `MULTILINGUAL_SPEC.md` section 8; use short codes (chosen).

**Consequences**: `MULTILINGUAL_SPEC.md` section 8 is updated to match. The Agreement page's own separate multilingual pattern (`templates/agreement-template.php`, ADR 0001) already used short codes (EN/NL/RU/UK) before this decision — the header switcher is now consistent with it, rather than being the odd one out.
