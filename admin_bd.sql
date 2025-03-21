PGDMP                           }            admin_bd    14.17    14.17 C    P           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            Q           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            R           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            S           1262    16394    admin_bd    DATABASE     W   CREATE DATABASE admin_bd WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'fr-FR';
    DROP DATABASE admin_bd;
                postgres    false            �            1259    16686    audit_virement    TABLE     �  CREATE TABLE public.audit_virement (
    id bigint NOT NULL,
    type_action character varying(255) NOT NULL,
    date_operation timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    numero_virement integer NOT NULL,
    numero_compte character varying(255) NOT NULL,
    nom_client character varying(255) NOT NULL,
    date_virement timestamp(0) without time zone NOT NULL,
    montant_ancien integer NOT NULL,
    montant_nouv integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT audit_virement_type_action_check CHECK (((type_action)::text = ANY ((ARRAY['ajout'::character varying, 'suppression'::character varying, 'modification'::character varying])::text[])))
);
 "   DROP TABLE public.audit_virement;
       public         heap    postgres    false            �            1259    16685    audit_virement_id_seq    SEQUENCE     ~   CREATE SEQUENCE public.audit_virement_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.audit_virement_id_seq;
       public          postgres    false    225            T           0    0    audit_virement_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.audit_virement_id_seq OWNED BY public.audit_virement.id;
          public          postgres    false    224            �            1259    16635    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    postgres    false            �            1259    16642    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    postgres    false            �            1259    16667    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    16666    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    221            U           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    220            �            1259    16659    job_batches    TABLE     d  CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap    postgres    false            �            1259    16650    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    postgres    false            �            1259    16649    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public          postgres    false    218            V           0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public          postgres    false    217            �            1259    16599 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    16598    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    210            W           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    209            �            1259    16619    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    16626    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    postgres    false            �            1259    16606    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    num_compte uuid NOT NULL,
    nom character varying(255) NOT NULL,
    solde integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    "isAdmin" boolean DEFAULT false NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16605    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    212            X           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    211            �            1259    16679 	   virements    TABLE     �   CREATE TABLE public.virements (
    num_virements integer NOT NULL,
    num_compte character varying(255) NOT NULL,
    montant integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.virements;
       public         heap    postgres    false            �            1259    16678    virements_num_virements_seq    SEQUENCE     �   CREATE SEQUENCE public.virements_num_virements_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.virements_num_virements_seq;
       public          postgres    false    223            Y           0    0    virements_num_virements_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.virements_num_virements_seq OWNED BY public.virements.num_virements;
          public          postgres    false    222            �           2604    16689    audit_virement id    DEFAULT     v   ALTER TABLE ONLY public.audit_virement ALTER COLUMN id SET DEFAULT nextval('public.audit_virement_id_seq'::regclass);
 @   ALTER TABLE public.audit_virement ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    225    225            �           2604    16670    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    221    221            �           2604    16653    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217    218            �           2604    16602    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    209    210    210            �           2604    16609    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    212    211    212            �           2604    16682    virements num_virements    DEFAULT     �   ALTER TABLE ONLY public.virements ALTER COLUMN num_virements SET DEFAULT nextval('public.virements_num_virements_seq'::regclass);
 F   ALTER TABLE public.virements ALTER COLUMN num_virements DROP DEFAULT;
       public          postgres    false    223    222    223            M          0    16686    audit_virement 
   TABLE DATA           �   COPY public.audit_virement (id, type_action, date_operation, numero_virement, numero_compte, nom_client, date_virement, montant_ancien, montant_nouv, created_at, updated_at) FROM stdin;
    public          postgres    false    225   O       C          0    16635    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public          postgres    false    215   �O       D          0    16642    cache_locks 
   TABLE DATA           =   COPY public.cache_locks (key, owner, expiration) FROM stdin;
    public          postgres    false    216   �O       I          0    16667    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    221   P       G          0    16659    job_batches 
   TABLE DATA           �   COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
    public          postgres    false    219   P       F          0    16650    jobs 
   TABLE DATA           c   COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
    public          postgres    false    218   ;P       >          0    16599 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    210   XP       A          0    16619    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    213   �P       B          0    16626    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public          postgres    false    214   �P       @          0    16606    users 
   TABLE DATA              COPY public.users (id, num_compte, nom, solde, email, password, "isAdmin", remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    212   �S       K          0    16679 	   virements 
   TABLE DATA           _   COPY public.virements (num_virements, num_compte, montant, created_at, updated_at) FROM stdin;
    public          postgres    false    223   U       Z           0    0    audit_virement_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.audit_virement_id_seq', 4, true);
          public          postgres    false    224            [           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    220            \           0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public          postgres    false    217            ]           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);
          public          postgres    false    209            ^           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 2, true);
          public          postgres    false    211            _           0    0    virements_num_virements_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.virements_num_virements_seq', 2, true);
          public          postgres    false    222            �           2606    16695 "   audit_virement audit_virement_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.audit_virement
    ADD CONSTRAINT audit_virement_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.audit_virement DROP CONSTRAINT audit_virement_pkey;
       public            postgres    false    225            �           2606    16648    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            postgres    false    216            �           2606    16641    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            postgres    false    215            �           2606    16675    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    221            �           2606    16677 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    221            �           2606    16665    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            postgres    false    219            �           2606    16657    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public            postgres    false    218            �           2606    16604    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    210            �           2606    16625 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    213            �           2606    16632    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            postgres    false    214            �           2606    16618    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    212            �           2606    16616    users users_num_compte_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_num_compte_unique UNIQUE (num_compte);
 G   ALTER TABLE ONLY public.users DROP CONSTRAINT users_num_compte_unique;
       public            postgres    false    212            �           2606    16614    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    212            �           2606    16684    virements virements_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.virements
    ADD CONSTRAINT virements_pkey PRIMARY KEY (num_virements);
 B   ALTER TABLE ONLY public.virements DROP CONSTRAINT virements_pkey;
       public            postgres    false    223            �           1259    16658    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            postgres    false    218            �           1259    16634    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            postgres    false    214            �           1259    16633    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            postgres    false    214            M   �   x���M�0F��Sp���O�t�ʅ'`C�DL�D��6���|�y/���e2d�a��@�D T]����Le���� ���X�08��P�R�d8���@}�S�t���m�>�O��ř�*Y��y;��q@��o��r\~S�e�q�6J�c�ߛ��>(�^Mk�      C      x������ � �      D      x������ � �      I      x������ � �      G      x������ � �      F      x������ � �      >   k   x�e�]
� �g=L�ZK&X�*���E�0��* @~�����]���v�(�&���n������+e�Cy;D�1�s������������E[h�/��AC      A      x������ � �      B   �  x�ՒKo�@����`�JU2�AQ�y�5oP70������I��jW�f1ҹ�����DL<$��Ʀ��n�%.dw��aW}w��#�f4�gh��L�H;�u�>����#k�gy��O�$��7��'n�uu�٦<?xq�E�n�{d����*紜V�'n]��M� ��pn�O_ʏ�Y��>�G��F-���4tl���R调�h+Aʚ�O����ё�q��z�b���*�h��_����/إ���Y��~e)m����n�q�A�����HFE4�0})n��)CV�i�+�;і�=YK(��:�ӧ9�ܷ�4uL��b�q}�A�Y�)y��I�>x�$��;��b�f���O<�e�����[^]�Aq�T�h���K^���'���N>��
H<��޳pc�7�͋GE�*(�p��*BEAQ�g((��۝'�Q�cUϨ|\�$<����&�
��B�M0&��:��z�x�v��·P'ؑ��^\ � �z '_|��� �$�3��x��4e'�K��t���i�w�Ņ���8|Yc\y��Bg�h:䖁İ��
*k�+���w#gêg�-L�>����c���oBh)����*v<m���y�ׂ�x�q�tQ�����ԯ����f^b��Le�tdQ�AϭN�������|>�����      @   ^  x�m��r�@�u�Y�m��/ YM(��	�ʦ�i0"�i5�>f�Sgq����B�,m���rK��)��)[I������� ����?�z����42c��5OU�0=|e�t�i��EW_J֮Er��9�F�չEٿlBtFQ7NN��'D��w<Y�!KS������w�.}�fډW��kufY(&��k�5��pL����ƒ1��1�])%hm����9�S��o��颻�g2��閳r2���,h��-�o��s�0yfq�0��*
Ԡt�:���^�0�Ҵ����Ww���R�E���E{T������SI|sv��	�6���<���6�,���      K   I   x�e��� ��T��p�h-y���KH���S�S��hx�V��=�
���hL5W�.r��/\�[D>n�7     