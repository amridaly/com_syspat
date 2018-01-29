
CREATE OR REPLACE  VIEW `ws_syspat_action_activ` AS 
select * from `ACTION_ACTIV`;

--
-- Structure de la vue `ws_syspat_action_activ_has_indic_pefa`
--

CREATE OR REPLACE VIEW `ws_syspat_action_activ_has_indic_pefa` AS 
select * from `ACTION_ACTIV_HAS_INDIC_PEFA`;

-- --------------------------------------------------------

--
-- Structure de la vue `ws_syspat_act_periods`
--

CREATE OR REPLACE  VIEW `ws_syspat_act_periods` AS 
select * from `ACT_PERIODS`;

-- --------------------------------------------------------

--
-- Structure de la vue `ws_syspat_eval_action_activ`
--

CREATE  OR REPLACE VIEW `ws_syspat_eval_action_activ` AS 
select * from `EVAL_ACTION_ACTIV`;

-- --------------------------------------------------------

--
-- Structure de la vue `ws_syspat_eval_act_indic_pefa`
--

CREATE OR REPLACE VIEW `ws_syspat_eval_act_indic_pefa` AS 
select * from `EVAL_ACT_INDIC_PEFA`;

-- --------------------------------------------------------

--
-- Structure de la vue `ws_syspat_indicator_pefa`
--

CREATE OR REPLACE VIEW `ws_syspat_indicator_pefa` AS 
select * from `INDICATOR_PEFA`;

-- 
-- Create or replace view ws_syspat_actions as
-- SELECT DISTINCT (a.ACTION_ACTIV_REF)as ACTION_ACTIV_REF, 
-- 	a.DESCRIPTION as DESCRIPTION, 
--         DATE_FORMAT(ACT_PERIODS.START_DATE, '%d/%m/%Y')as START_DATE, 
--         DATE_FORMAT(ACT_PERIODS.DUE_DATE, '%d/%m/%Y') as DUE_DATE,
-- 	s.STRUCTURE_CODE, 
--         r.NAME as RESPONSIBLE_NAME, 
--         a.DOMAIN_CODE, 
--         a.DIMENSION_CODE 
-- FROM ACTION_ACTIV as a LEFT OUTER JOIN STRC_HAS_DOMN_HAS_RESP as hdr on a.ID_STRC_HAS_DOMN_HAS_RESP = hdr.ID_STRC_HAS_DOMN_HAS_RESP  
--     LEFT OUTER JOIN RESPONSIBLE as r on hdr.ID_RESPONSIBLE = r.ID_RESPONSIBLE 
--     INNER JOIN STRUCTURE as s on hdr.ID_STRUCTURE = s.ID_STRUCTURE  
--     LEFT OUTER JOIN ACT_PERIODS on a.ACTION_ACTIV_REF = ACT_PERIODS.ACTION_ACTIV_REF  
--     LEFT OUTER JOIN DOMAIN_GOAL as s ON d.DOMAIN_CODE = a.DOMAIN_CODE  
--     LEFT OUTER JOIN DOMAIN_RESULT ON DOMAIN_RESULT.DOMAIN_CODE = a.DOMAIN_CODE   
--     LEFT OUTER JOIN ACTION_ACTIV_HAS_INDIC_PEFA ON ACTION_ACTIV_HAS_INDIC_PEFA.ACTION_ACTIV_REF = a.ACTION_ACTIV_REF  
--     LEFT OUTER JOIN ACT_RESOURCE ON ACT_RESOURCE.ACTION_ACTIV_REF = a.ACTION_ACTIV_REF; 


Create or replace view ws_syspat_actions as
SELECT DISTINCT (a.ACTION_ACTIV_REF)as ACTION_ACTIV_REF, 
	a.DESCRIPTION as DESCRIPTION, 
        DATE_FORMAT(ACT_PERIODS.START_DATE, '%d/%m/%Y')as START_DATE, 
        DATE_FORMAT(ACT_PERIODS.DUE_DATE, '%d/%m/%Y') as DUE_DATE,
	s.STRUCTURE_CODE, s.STRUCTURE_LABEL,
        a.DOMAIN_CODE,d.DOMAIN_LABEL
FROM ACTION_ACTIV as a INNER JOIN DOMAIN  as d on a.DOMAIN_CODE = d.DOMAIN_CODE 
    LEFT OUTER JOIN STRC_HAS_DOMN_HAS_RESP as hdr on a.ID_STRC_HAS_DOMN_HAS_RESP = hdr.ID_STRC_HAS_DOMN_HAS_RESP  
    INNER JOIN STRUCTURE as s on hdr.ID_STRUCTURE = s.ID_STRUCTURE  
    LEFT OUTER JOIN ACT_PERIODS on a.ACTION_ACTIV_REF = ACT_PERIODS.ACTION_ACTIV_REF; 


