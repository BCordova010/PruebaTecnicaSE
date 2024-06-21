--
-- PostgreSQL database dump
--

-- Dumped from database version 16.3
-- Dumped by pg_dump version 16.3

-- Started on 2024-06-21 11:04:31

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 4813 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 218 (class 1259 OID 16431)
-- Name: bodega; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bodega (
    bodega_id bigint NOT NULL,
    codigo_bodega character varying NOT NULL,
    nombre_bodega character varying NOT NULL,
    direccion_bodega character varying NOT NULL,
    dotacion_bodega integer NOT NULL,
    estado_bodega boolean DEFAULT true NOT NULL,
    registro_creacion_bodega timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.bodega OWNER TO postgres;

--
-- TOC entry 4814 (class 0 OID 0)
-- Dependencies: 218
-- Name: TABLE bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.bodega IS 'Tabla que contiene las bodegas del sistema';


--
-- TOC entry 4815 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.bodega_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.bodega_id IS 'Identificador primario de la tabla Bodega';


--
-- TOC entry 4816 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.codigo_bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.codigo_bodega IS 'código identificador de la bodega';


--
-- TOC entry 4817 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.nombre_bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.nombre_bodega IS 'Nombre de la bodega';


--
-- TOC entry 4818 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.direccion_bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.direccion_bodega IS 'Dirección correspondiente de la bodega';


--
-- TOC entry 4819 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.dotacion_bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.dotacion_bodega IS 'Valor que indica la cantidad de personas que trabajan en la bodega';


--
-- TOC entry 4820 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.estado_bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.estado_bodega IS 'estado de la bodega (activada/desactivada)';


--
-- TOC entry 4821 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN bodega.registro_creacion_bodega; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega.registro_creacion_bodega IS 'Fecha de creación del registro de la bodega';


--
-- TOC entry 217 (class 1259 OID 16430)
-- Name: bodega_bodega_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bodega_bodega_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.bodega_bodega_id_seq OWNER TO postgres;

--
-- TOC entry 4822 (class 0 OID 0)
-- Dependencies: 217
-- Name: bodega_bodega_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bodega_bodega_id_seq OWNED BY public.bodega.bodega_id;


--
-- TOC entry 220 (class 1259 OID 16442)
-- Name: bodega_funcionario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bodega_funcionario (
    id_bod_func bigint NOT NULL,
    bf_bodega_id bigint NOT NULL,
    bf_if_funcionario bigint NOT NULL
);


ALTER TABLE public.bodega_funcionario OWNER TO postgres;

--
-- TOC entry 4823 (class 0 OID 0)
-- Dependencies: 220
-- Name: TABLE bodega_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.bodega_funcionario IS 'Tabla que contiene la conexión múltiple de funcionarios en las bodegas';


--
-- TOC entry 4824 (class 0 OID 0)
-- Dependencies: 220
-- Name: COLUMN bodega_funcionario.id_bod_func; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega_funcionario.id_bod_func IS 'Identificador primeraio de la tabla bodega_funcionario';


--
-- TOC entry 4825 (class 0 OID 0)
-- Dependencies: 220
-- Name: COLUMN bodega_funcionario.bf_bodega_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega_funcionario.bf_bodega_id IS 'Identificador foráneo de la tabla bodega';


--
-- TOC entry 4826 (class 0 OID 0)
-- Dependencies: 220
-- Name: COLUMN bodega_funcionario.bf_if_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.bodega_funcionario.bf_if_funcionario IS 'Identificador de la tabla funcionario, el cual puede ser múltiple';


--
-- TOC entry 219 (class 1259 OID 16441)
-- Name: bodega_funcionario_id_bod_func_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bodega_funcionario_id_bod_func_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.bodega_funcionario_id_bod_func_seq OWNER TO postgres;

--
-- TOC entry 4827 (class 0 OID 0)
-- Dependencies: 219
-- Name: bodega_funcionario_id_bod_func_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bodega_funcionario_id_bod_func_seq OWNED BY public.bodega_funcionario.id_bod_func;


--
-- TOC entry 216 (class 1259 OID 16415)
-- Name: funcionario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.funcionario (
    funcionario_id bigint NOT NULL,
    rut_funcionario character varying NOT NULL,
    nombre_funcionario character varying NOT NULL,
    appat_funcionario character varying NOT NULL,
    apmat_funcionario character varying NOT NULL,
    direccion_funcionario character varying NOT NULL,
    telefono_funcionario integer NOT NULL
);


ALTER TABLE public.funcionario OWNER TO postgres;

--
-- TOC entry 4828 (class 0 OID 0)
-- Dependencies: 216
-- Name: TABLE funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.funcionario IS 'Tabla que almacena los funcionarios del sistema';


--
-- TOC entry 4829 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.funcionario_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.funcionario_id IS 'Identificador primario de la tabla funcionario';


--
-- TOC entry 4830 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.rut_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.rut_funcionario IS 'Rut correspondiente al funcionario';


--
-- TOC entry 4831 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.nombre_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.nombre_funcionario IS 'Nombre del funcionario';


--
-- TOC entry 4832 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.appat_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.appat_funcionario IS 'Apellido paterno del funcionario';


--
-- TOC entry 4833 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.apmat_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.apmat_funcionario IS 'Apellido materno del funcionario';


--
-- TOC entry 4834 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.direccion_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.direccion_funcionario IS 'Dirección proporcionada por el funcionario';


--
-- TOC entry 4835 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN funcionario.telefono_funcionario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.funcionario.telefono_funcionario IS 'Número de contacto del funcionario';


--
-- TOC entry 215 (class 1259 OID 16414)
-- Name: funcionario_id_funcionario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.funcionario_id_funcionario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.funcionario_id_funcionario_seq OWNER TO postgres;

--
-- TOC entry 4836 (class 0 OID 0)
-- Dependencies: 215
-- Name: funcionario_id_funcionario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.funcionario_id_funcionario_seq OWNED BY public.funcionario.funcionario_id;


--
-- TOC entry 4645 (class 2604 OID 16434)
-- Name: bodega bodega_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega ALTER COLUMN bodega_id SET DEFAULT nextval('public.bodega_bodega_id_seq'::regclass);


--
-- TOC entry 4648 (class 2604 OID 16445)
-- Name: bodega_funcionario id_bod_func; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega_funcionario ALTER COLUMN id_bod_func SET DEFAULT nextval('public.bodega_funcionario_id_bod_func_seq'::regclass);


--
-- TOC entry 4644 (class 2604 OID 16418)
-- Name: funcionario funcionario_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario ALTER COLUMN funcionario_id SET DEFAULT nextval('public.funcionario_id_funcionario_seq'::regclass);


--
-- TOC entry 4805 (class 0 OID 16431)
-- Dependencies: 218
-- Data for Name: bodega; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bodega (bodega_id, codigo_bodega, nombre_bodega, direccion_bodega, dotacion_bodega, estado_bodega, registro_creacion_bodega) FROM stdin;
7	0004A	Prueba desactivada	Rio	2	f	2024-06-20 22:34:17.932353
8	0023B	prueba encargados	banderas	5	t	2024-06-21 00:24:33.765887
9	0009S	prueba de llenado	ciudad	7	t	2024-06-21 10:40:06.974521
10	0002B	prueba de llenado2	blanca	6	f	2024-06-21 10:40:37.885085
11	12345	prueba de llenado3	casablanca	12	t	2024-06-21 10:41:22.476308
\.


--
-- TOC entry 4807 (class 0 OID 16442)
-- Dependencies: 220
-- Data for Name: bodega_funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bodega_funcionario (id_bod_func, bf_bodega_id, bf_if_funcionario) FROM stdin;
4	7	2
5	7	3
6	7	4
7	8	1
8	8	2
9	8	3
10	8	4
11	8	5
19	9	1
20	9	2
21	9	3
22	9	4
23	10	2
24	10	3
25	10	4
26	10	5
27	11	1
28	11	3
29	11	5
\.


--
-- TOC entry 4803 (class 0 OID 16415)
-- Dependencies: 216
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionario (funcionario_id, rut_funcionario, nombre_funcionario, appat_funcionario, apmat_funcionario, direccion_funcionario, telefono_funcionario) FROM stdin;
1	12345678-9	Juan	Pérez	González	Av. Siempre Viva 123	123456789
2	98765432-1	María	López	Martínez	Calle Real 456	987654321
3	11111111-1	Pedro	Rodríguez	Hernández	Camino Real 789	111111111
4	22222222-2	Ana	García	Sánchez	Av. Principal 101	222222222
5	33333333-3	Carlos	Martín	López	Calle Secundaria 202	333333333
\.


--
-- TOC entry 4837 (class 0 OID 0)
-- Dependencies: 217
-- Name: bodega_bodega_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bodega_bodega_id_seq', 11, true);


--
-- TOC entry 4838 (class 0 OID 0)
-- Dependencies: 219
-- Name: bodega_funcionario_id_bod_func_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bodega_funcionario_id_bod_func_seq', 29, true);


--
-- TOC entry 4839 (class 0 OID 0)
-- Dependencies: 215
-- Name: funcionario_id_funcionario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.funcionario_id_funcionario_seq', 5, true);


--
-- TOC entry 4656 (class 2606 OID 16447)
-- Name: bodega_funcionario bodega_funcionario_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega_funcionario
    ADD CONSTRAINT bodega_funcionario_pk PRIMARY KEY (id_bod_func);


--
-- TOC entry 4652 (class 2606 OID 16461)
-- Name: bodega bodega_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega
    ADD CONSTRAINT bodega_unique UNIQUE (codigo_bodega);


--
-- TOC entry 4654 (class 2606 OID 16440)
-- Name: bodega bodegas_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega
    ADD CONSTRAINT bodegas_pk PRIMARY KEY (bodega_id);


--
-- TOC entry 4650 (class 2606 OID 16422)
-- Name: funcionario funcionario_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_pk PRIMARY KEY (funcionario_id);


--
-- TOC entry 4657 (class 2606 OID 16462)
-- Name: bodega_funcionario bodega_funcionario_bodega_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega_funcionario
    ADD CONSTRAINT bodega_funcionario_bodega_fk FOREIGN KEY (bf_bodega_id) REFERENCES public.bodega(bodega_id);


--
-- TOC entry 4658 (class 2606 OID 16467)
-- Name: bodega_funcionario bodega_funcionario_funcionario_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bodega_funcionario
    ADD CONSTRAINT bodega_funcionario_funcionario_fk FOREIGN KEY (bf_if_funcionario) REFERENCES public.funcionario(funcionario_id);


-- Completed on 2024-06-21 11:04:31

--
-- PostgreSQL database dump complete
--

