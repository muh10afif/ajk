PGDMP     $    6                y            ajk    11.3    11.3 #   ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            ?           1262    17816    ajk    DATABASE     ?   CREATE DATABASE ajk WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE ajk;
             postgres    false            ?            1259    17969    dokumen    TABLE       CREATE TABLE public.dokumen (
    id_dokumen bigint NOT NULL,
    nama_dokumen character varying(255),
    dokumen character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_pertanggungan bigint,
    flag_validasi bigint
);
    DROP TABLE public.dokumen;
       public         postgres    false            
           1259    33042    dokumen_asuransi    TABLE       CREATE TABLE public.dokumen_asuransi (
    id_dokumen_asuransi bigint NOT NULL,
    nama_dokumen character varying(255),
    id_syarat_pertanggungan bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    jenis_dokumen character varying(255)
);
 $   DROP TABLE public.dokumen_asuransi;
       public         postgres    false                       1259    33086    dokumen_cbc    TABLE       CREATE TABLE public.dokumen_cbc (
    id_dokumen_cbc bigint NOT NULL,
    dokumen character varying(255),
    id_dok_underwriting bigint,
    flag_validasi bigint DEFAULT 0,
    id_resiko_ptg bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.dokumen_cbc;
       public         postgres    false            ?            1259    32831 
   m_asuransi    TABLE     5  CREATE TABLE public.m_asuransi (
    id_asuransi bigint NOT NULL,
    nama_asuransi character varying(255),
    alamat text,
    email character varying(255),
    no_telepon character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    singkatan character varying(100)
);
    DROP TABLE public.m_asuransi;
       public         postgres    false            ?            1259    32840    id_asuransi_seq    SEQUENCE     x   CREATE SEQUENCE public.id_asuransi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.id_asuransi_seq;
       public       postgres    false    232            ?           0    0    id_asuransi_seq    SEQUENCE OWNED BY     N   ALTER SEQUENCE public.id_asuransi_seq OWNED BY public.m_asuransi.id_asuransi;
            public       postgres    false    233            ?            1259    17847    m_bpr    TABLE     ?   CREATE TABLE public.m_bpr (
    id_bpr bigint NOT NULL,
    nama_bpr character varying(255),
    email character varying(255),
    kontak character varying(255),
    alamat text,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_bpr;
       public         postgres    false            ?            1259    17888 
   id_bpr_seq    SEQUENCE     s   CREATE SEQUENCE public.id_bpr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.id_bpr_seq;
       public       postgres    false    202            ?           0    0 
   id_bpr_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.id_bpr_seq OWNED BY public.m_bpr.id_bpr;
            public       postgres    false    208            ?            1259    17860 	   m_debitur    TABLE     ?  CREATE TABLE public.m_debitur (
    id_debitur bigint NOT NULL,
    nama_lengkap character varying(255),
    jenis_kelamin character varying(255),
    tempat_lahir character varying(255),
    tgl_lahir date,
    jenis_identitas character varying(50),
    no_identitas character varying(100),
    status_nikah character varying(100),
    warga_negara character varying(10),
    agama character varying(25),
    alamat_rumah text,
    kode_pos_rumah character varying(10),
    alamat_korespondensi text,
    kode_pos_korespondensi character varying(10),
    kontak character varying(50),
    email character varying(100),
    pekerjaan character varying(200),
    bagian character varying(200),
    alamat_kantor text,
    kode_pos_kantor character varying(10),
    tujuan_beli_asuransi text,
    sumber_dana_pembelian character varying(255),
    pengahasilan_per_tahun bigint,
    sumber_dana_penghasilan character varying(255),
    id_pks bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    nik character varying(255),
    negara_wna character varying(255),
    sumber_dana_pembelian_lainnya character varying(255),
    sumber_dana_penghasilan_lainnya character varying(255),
    provinsi_rumah bigint,
    kota_kab_rumah bigint,
    kecamatan_rumah bigint,
    provinsi_korespondensi bigint,
    kota_kab_korespondensi bigint,
    kecamatan_korespondensi bigint,
    provinsi_kantor bigint,
    kota_kab_kantor bigint,
    kecamatan_kantor bigint,
    usia bigint
);
    DROP TABLE public.m_debitur;
       public         postgres    false            ?            1259    17891    id_debitur_seq    SEQUENCE     w   CREATE SEQUENCE public.id_debitur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.id_debitur_seq;
       public       postgres    false    204            ?           0    0    id_debitur_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.id_debitur_seq OWNED BY public.m_debitur.id_debitur;
            public       postgres    false    209            ?            1259    32920    m_dok_underwriting    TABLE     ?   CREATE TABLE public.m_dok_underwriting (
    id_dok_underwriting bigint NOT NULL,
    jenis_dokumen character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 &   DROP TABLE public.m_dok_underwriting;
       public         postgres    false            ?            1259    32926    id_dok_underwriting_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_dok_underwriting_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.id_dok_underwriting_seq;
       public       postgres    false    248            ?           0    0    id_dok_underwriting_seq    SEQUENCE OWNED BY     f   ALTER SEQUENCE public.id_dok_underwriting_seq OWNED BY public.m_dok_underwriting.id_dok_underwriting;
            public       postgres    false    249                       1259    33048    id_dokumen_asuransi_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_dokumen_asuransi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.id_dokumen_asuransi_seq;
       public       postgres    false    266            ?           0    0    id_dokumen_asuransi_seq    SEQUENCE OWNED BY     d   ALTER SEQUENCE public.id_dokumen_asuransi_seq OWNED BY public.dokumen_asuransi.id_dokumen_asuransi;
            public       postgres    false    267                       1259    33092    id_dokumen_cbc_seq    SEQUENCE     {   CREATE SEQUENCE public.id_dokumen_cbc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.id_dokumen_cbc_seq;
       public       postgres    false    268            ?           0    0    id_dokumen_cbc_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.id_dokumen_cbc_seq OWNED BY public.dokumen_cbc.id_dokumen_cbc;
            public       postgres    false    269            ?            1259    17977    id_dokumen_seq    SEQUENCE     w   CREATE SEQUENCE public.id_dokumen_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.id_dokumen_seq;
       public       postgres    false    222            ?           0    0    id_dokumen_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.id_dokumen_seq OWNED BY public.dokumen.id_dokumen;
            public       postgres    false    223            ?            1259    32864    m_jenis_jaminan    TABLE     ?   CREATE TABLE public.m_jenis_jaminan (
    id_jenis_jaminan bigint NOT NULL,
    jenis_jaminan character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 #   DROP TABLE public.m_jenis_jaminan;
       public         postgres    false            ?            1259    32870    id_jenis_jaminan_seq    SEQUENCE     }   CREATE SEQUENCE public.id_jenis_jaminan_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.id_jenis_jaminan_seq;
       public       postgres    false    238            ?           0    0    id_jenis_jaminan_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.id_jenis_jaminan_seq OWNED BY public.m_jenis_jaminan.id_jenis_jaminan;
            public       postgres    false    239            ?            1259    17837    m_jenis_kredit    TABLE     ?   CREATE TABLE public.m_jenis_kredit (
    id_jenis_kredit bigint NOT NULL,
    jenis_kredit character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 "   DROP TABLE public.m_jenis_kredit;
       public         postgres    false            ?            1259    17893    id_jenis_kredit_seq    SEQUENCE     |   CREATE SEQUENCE public.id_jenis_kredit_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.id_jenis_kredit_seq;
       public       postgres    false    200            ?           0    0    id_jenis_kredit_seq    SEQUENCE OWNED BY     Z   ALTER SEQUENCE public.id_jenis_kredit_seq OWNED BY public.m_jenis_kredit.id_jenis_kredit;
            public       postgres    false    210            ?            1259    17842    m_jenis_tanggung    TABLE     ?   CREATE TABLE public.m_jenis_tanggung (
    id_jenis_tanggung bigint NOT NULL,
    jenis_tanggung character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 $   DROP TABLE public.m_jenis_tanggung;
       public         postgres    false            ?            1259    17895    id_jenis_pertanggungan_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_jenis_pertanggungan_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.id_jenis_pertanggungan_seq;
       public       postgres    false    201            ?           0    0    id_jenis_pertanggungan_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.id_jenis_pertanggungan_seq OWNED BY public.m_jenis_tanggung.id_jenis_tanggung;
            public       postgres    false    211                       1259    33095    m_jenis_produk    TABLE     ?   CREATE TABLE public.m_jenis_produk (
    id_jenis_produk bigint NOT NULL,
    jenis_produk character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 "   DROP TABLE public.m_jenis_produk;
       public         postgres    false                       1259    33101    id_jenis_produk_seq    SEQUENCE     |   CREATE SEQUENCE public.id_jenis_produk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.id_jenis_produk_seq;
       public       postgres    false    270            ?           0    0    id_jenis_produk_seq    SEQUENCE OWNED BY     Z   ALTER SEQUENCE public.id_jenis_produk_seq OWNED BY public.m_jenis_produk.id_jenis_produk;
            public       postgres    false    271                       1259    33104    m_jenis_resiko    TABLE     ?   CREATE TABLE public.m_jenis_resiko (
    id_jenis_resiko bigint NOT NULL,
    jenis_resiko character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    tampil_otomatis bigint
);
 "   DROP TABLE public.m_jenis_resiko;
       public         postgres    false                       1259    33110    id_jenis_resiko_seq    SEQUENCE     |   CREATE SEQUENCE public.id_jenis_resiko_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.id_jenis_resiko_seq;
       public       postgres    false    272            ?           0    0    id_jenis_resiko_seq    SEQUENCE OWNED BY     Z   ALTER SEQUENCE public.id_jenis_resiko_seq OWNED BY public.m_jenis_resiko.id_jenis_resiko;
            public       postgres    false    273            ?            1259    17832    m_kecamatan    TABLE     ?   CREATE TABLE public.m_kecamatan (
    id_kecamatan bigint NOT NULL,
    nama_kecamatan character varying(255),
    id_kota_kab bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_kecamatan;
       public         postgres    false            ?            1259    17897    id_kecamatan_seq    SEQUENCE     y   CREATE SEQUENCE public.id_kecamatan_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.id_kecamatan_seq;
       public       postgres    false    199            ?           0    0    id_kecamatan_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.id_kecamatan_seq OWNED BY public.m_kecamatan.id_kecamatan;
            public       postgres    false    212            ?            1259    32843 
   tr_klausul    TABLE     L  CREATE TABLE public.tr_klausul (
    id_klausul bigint NOT NULL,
    id_asuransi bigint,
    id_syarat_pertanggungan bigint,
    kode_underwriting character varying(100),
    kode_tarif_perusia character varying(100),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    kode_klausul character varying(100)
);
    DROP TABLE public.tr_klausul;
       public         postgres    false            ?            1259    32851    id_klausul_seq    SEQUENCE     w   CREATE SEQUENCE public.id_klausul_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.id_klausul_seq;
       public       postgres    false    234            ?           0    0    id_klausul_seq    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.id_klausul_seq OWNED BY public.tr_klausul.id_klausul;
            public       postgres    false    235            ?            1259    17827 
   m_kota_kab    TABLE     ?   CREATE TABLE public.m_kota_kab (
    id_kota_kab bigint NOT NULL,
    nama_kota_kab character varying(255),
    id_provinsi bigint,
    add_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_kota_kab;
       public         postgres    false            ?            1259    17899    id_kota_kab_seq    SEQUENCE     x   CREATE SEQUENCE public.id_kota_kab_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.id_kota_kab_seq;
       public       postgres    false    198            ?           0    0    id_kota_kab_seq    SEQUENCE OWNED BY     N   ALTER SEQUENCE public.id_kota_kab_seq OWNED BY public.m_kota_kab.id_kota_kab;
            public       postgres    false    213            ?            1259    32873    kriteria_peserta    TABLE     x  CREATE TABLE public.kriteria_peserta (
    id_kriteria_peserta bigint NOT NULL,
    id_jenis_kredit bigint,
    no_perjanjian_kredit character varying(255),
    nama character varying(100),
    jenis_kelamin character varying(100),
    no_identitas character varying(255),
    tanggal_lahir date,
    alamat text,
    plafond_kredit double precision,
    jangka_waktu_tenor bigint,
    tgl_mulai_kredit date,
    tgl_berakhir_kredit date,
    rate double precision,
    jaminan character varying(255),
    id_jenis_jaminan bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    premi double precision
);
 $   DROP TABLE public.kriteria_peserta;
       public         postgres    false            ?            1259    32882    id_kriteria_peserta_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_kriteria_peserta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.id_kriteria_peserta_seq;
       public       postgres    false    240                        0    0    id_kriteria_peserta_seq    SEQUENCE OWNED BY     d   ALTER SEQUENCE public.id_kriteria_peserta_seq OWNED BY public.kriteria_peserta.id_kriteria_peserta;
            public       postgres    false    241            ?            1259    32762    m_level    TABLE     ?   CREATE TABLE public.m_level (
    id_level bigint NOT NULL,
    level character varying(100),
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_level;
       public         postgres    false            ?            1259    32767    id_level_seq    SEQUENCE     u   CREATE SEQUENCE public.id_level_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.id_level_seq;
       public       postgres    false    224                       0    0    id_level_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.id_level_seq OWNED BY public.m_level.id_level;
            public       postgres    false    225            ?            1259    17817    m_negara    TABLE     ?   CREATE TABLE public.m_negara (
    id_negara bigint NOT NULL,
    nama_negara character varying(255),
    add_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_negara;
       public         postgres    false            ?            1259    17884    id_negara_seq    SEQUENCE     v   CREATE SEQUENCE public.id_negara_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.id_negara_seq;
       public       postgres    false    196                       0    0    id_negara_seq    SEQUENCE OWNED BY     H   ALTER SEQUENCE public.id_negara_seq OWNED BY public.m_negara.id_negara;
            public       postgres    false    207            ?            1259    32944    tr_penawaran    TABLE     D  CREATE TABLE public.tr_penawaran (
    id_penawaran bigint NOT NULL,
    nomor_penawaran character varying(100),
    id_bpr bigint,
    kode_klausul character varying(100),
    status smallint,
    dokumen character varying(255),
    add_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_asuransi bigint
);
     DROP TABLE public.tr_penawaran;
       public         postgres    false            ?            1259    32950    id_penawaran_seq    SEQUENCE     y   CREATE SEQUENCE public.id_penawaran_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.id_penawaran_seq;
       public       postgres    false    252                       0    0    id_penawaran_seq    SEQUENCE OWNED BY     R   ALTER SEQUENCE public.id_penawaran_seq OWNED BY public.tr_penawaran.id_penawaran;
            public       postgres    false    253            ?            1259    17957    pertanggungan    TABLE     ?  CREATE TABLE public.pertanggungan (
    id_pertanggungan bigint NOT NULL,
    id_debitur bigint,
    cara_bayar character varying(150),
    kredit_bank character varying(150),
    ahli_waris character varying(150),
    hubungan_ahli_waris character varying(150),
    tanya_data_asuransi character varying(10),
    tanya_data_asuransi_jelaskan text,
    tinggi_badan double precision,
    berat_badan double precision,
    tanya_kesehatan_1 text,
    tanya_kesehatan_2 text,
    tanya_kesehatan_3 text,
    tanya_hamil character varying(10),
    hamil_anak_ke bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    kode_tertanggung character varying(100),
    id_status_lengkap_dokumen bigint,
    id_status_polish bigint DEFAULT 0,
    id_status_tertanggung bigint,
    tanya_kesehatan_1_sts smallint,
    tanya_kesehatan_2_sts smallint,
    tanya_kesehatan_3_sts smallint,
    forward_asuransi bigint DEFAULT 0
);
 !   DROP TABLE public.pertanggungan;
       public         postgres    false            ?            1259    17965    id_pertanggungan_seq    SEQUENCE     }   CREATE SEQUENCE public.id_pertanggungan_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.id_pertanggungan_seq;
       public       postgres    false    220                       0    0    id_pertanggungan_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.id_pertanggungan_seq OWNED BY public.pertanggungan.id_pertanggungan;
            public       postgres    false    221            ?            1259    32953    tr_pks    TABLE     ?   CREATE TABLE public.tr_pks (
    id_pks bigint NOT NULL,
    nomor_pks character varying(100),
    id_soc bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_penawaran bigint
);
    DROP TABLE public.tr_pks;
       public         postgres    false            ?            1259    32959 
   id_pks_seq    SEQUENCE     s   CREATE SEQUENCE public.id_pks_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.id_pks_seq;
       public       postgres    false    254                       0    0 
   id_pks_seq    SEQUENCE OWNED BY     @   ALTER SEQUENCE public.id_pks_seq OWNED BY public.tr_pks.id_pks;
            public       postgres    false    255            ?            1259    32885 	   m_plafond    TABLE     ?   CREATE TABLE public.m_plafond (
    id_plafond bigint NOT NULL,
    plafond character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    plafond_awal double precision,
    plafond_akhir double precision
);
    DROP TABLE public.m_plafond;
       public         postgres    false            ?            1259    32891    id_plafond_seq    SEQUENCE     w   CREATE SEQUENCE public.id_plafond_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.id_plafond_seq;
       public       postgres    false    242                       0    0    id_plafond_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.id_plafond_seq OWNED BY public.m_plafond.id_plafond;
            public       postgres    false    243            ?            1259    17822 
   m_provinsi    TABLE     ?   CREATE TABLE public.m_provinsi (
    id_provinsi bigint NOT NULL,
    nama_provinsi character varying(255),
    id_negara bigint,
    add_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_provinsi;
       public         postgres    false            ?            1259    17901    id_provinsi_seq    SEQUENCE     x   CREATE SEQUENCE public.id_provinsi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.id_provinsi_seq;
       public       postgres    false    197                       0    0    id_provinsi_seq    SEQUENCE OWNED BY     N   ALTER SEQUENCE public.id_provinsi_seq OWNED BY public.m_provinsi.id_provinsi;
            public       postgres    false    214            ?            1259    17934    m_range_bpr    TABLE     ?   CREATE TABLE public.m_range_bpr (
    id_range_bpr bigint NOT NULL,
    range_penghasilan_tahun bigint,
    id_bpr bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.m_range_bpr;
       public         postgres    false            ?            1259    17939    id_range_bpr_seq    SEQUENCE     y   CREATE SEQUENCE public.id_range_bpr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.id_range_bpr_seq;
       public       postgres    false    218                       0    0    id_range_bpr_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.id_range_bpr_seq OWNED BY public.m_range_bpr.id_range_bpr;
            public       postgres    false    219                       1259    33254    tr_resiko_ptg    TABLE     I  CREATE TABLE public.tr_resiko_ptg (
    id_resiko_ptg bigint NOT NULL,
    id_debitur bigint,
    id_jenis_kredit bigint,
    id_jenis_tanggung bigint,
    id_jenis_resiko bigint,
    uang_ptg double precision,
    bunga double precision,
    tgl_akad date,
    periode_asuransi_awal date,
    periode_asuransi_akhir date,
    masa_asuransi bigint,
    id_status_cash bigint,
    premi double precision,
    id_status_underwriting bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    kode_tertanggung character varying(100),
    id_jenis_produk bigint
);
 !   DROP TABLE public.tr_resiko_ptg;
       public         postgres    false                       1259    33260    id_resiko_ptg_seq    SEQUENCE     z   CREATE SEQUENCE public.id_resiko_ptg_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.id_resiko_ptg_seq;
       public       postgres    false    276            	           0    0    id_resiko_ptg_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.id_resiko_ptg_seq OWNED BY public.tr_resiko_ptg.id_resiko_ptg;
            public       postgres    false    277                        1259    32962    tr_soc    TABLE     {  CREATE TABLE public.tr_soc (
    id_soc bigint NOT NULL,
    soc double precision,
    komisi_agent double precision,
    feebase double precision,
    overiding double precision,
    komisi_net_broker double precision,
    net_fee_broker double precision,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_bpr bigint,
    jumlah_detail_soc bigint
);
    DROP TABLE public.tr_soc;
       public         postgres    false                       1259    32969 
   id_soc_seq    SEQUENCE     s   CREATE SEQUENCE public.id_soc_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.id_soc_seq;
       public       postgres    false    256            
           0    0 
   id_soc_seq    SEQUENCE OWNED BY     @   ALTER SEQUENCE public.id_soc_seq OWNED BY public.tr_soc.id_soc;
            public       postgres    false    257            ?            1259    17855    m_spk    TABLE     ?   CREATE TABLE public.m_spk (
    id_spk bigint NOT NULL,
    no_spk character varying(255),
    tgl_mulai date,
    tgl_berakhir date,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_bpr bigint
);
    DROP TABLE public.m_spk;
       public         postgres    false            ?            1259    17903 
   id_spk_seq    SEQUENCE     s   CREATE SEQUENCE public.id_spk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.id_spk_seq;
       public       postgres    false    203                       0    0 
   id_spk_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.id_spk_seq OWNED BY public.m_spk.id_spk;
            public       postgres    false    215                       1259    32983    m_status_cash    TABLE     ?   CREATE TABLE public.m_status_cash (
    id_status_cash bigint NOT NULL,
    status_cash character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 !   DROP TABLE public.m_status_cash;
       public         postgres    false                       1259    32989    id_status_cash_seq    SEQUENCE     {   CREATE SEQUENCE public.id_status_cash_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.id_status_cash_seq;
       public       postgres    false    258                       0    0    id_status_cash_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.id_status_cash_seq OWNED BY public.m_status_cash.id_status_cash;
            public       postgres    false    259                       1259    32992    m_status_lengkap_dokumen    TABLE     ?   CREATE TABLE public.m_status_lengkap_dokumen (
    id_status_lengkap_dokumen bigint NOT NULL,
    status_lengkap_dokumen character varying,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 ,   DROP TABLE public.m_status_lengkap_dokumen;
       public         postgres    false                       1259    33001    id_status_lengkap_dokumen_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_status_lengkap_dokumen_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.id_status_lengkap_dokumen_seq;
       public       postgres    false    260                       0    0    id_status_lengkap_dokumen_seq    SEQUENCE OWNED BY     x   ALTER SEQUENCE public.id_status_lengkap_dokumen_seq OWNED BY public.m_status_lengkap_dokumen.id_status_lengkap_dokumen;
            public       postgres    false    261                       1259    33004    m_status_polish    TABLE     ?   CREATE TABLE public.m_status_polish (
    id_status_polish bigint NOT NULL,
    status_polish character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 #   DROP TABLE public.m_status_polish;
       public         postgres    false                       1259    33010    id_status_polish_seq    SEQUENCE     }   CREATE SEQUENCE public.id_status_polish_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.id_status_polish_seq;
       public       postgres    false    262                       0    0    id_status_polish_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.id_status_polish_seq OWNED BY public.m_status_polish.id_status_polish;
            public       postgres    false    263                       1259    33013    m_status_tertanggung    TABLE     ?   CREATE TABLE public.m_status_tertanggung (
    id_status_tertanggung bigint NOT NULL,
    status_tertanggung character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 (   DROP TABLE public.m_status_tertanggung;
       public         postgres    false            	           1259    33019    id_status_tertanggung_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_status_tertanggung_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.id_status_tertanggung_seq;
       public       postgres    false    264                       0    0    id_status_tertanggung_seq    SEQUENCE OWNED BY     l   ALTER SEQUENCE public.id_status_tertanggung_seq OWNED BY public.m_status_tertanggung.id_status_tertanggung;
            public       postgres    false    265            ?            1259    32907    m_status_underwriting    TABLE     ?   CREATE TABLE public.m_status_underwriting (
    id_status_underwriting bigint NOT NULL,
    status_underwriting character varying(255),
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 )   DROP TABLE public.m_status_underwriting;
       public         postgres    false            ?            1259    32913    id_status_underwriting_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_status_underwriting_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.id_status_underwriting_seq;
       public       postgres    false    246                       0    0    id_status_underwriting_seq    SEQUENCE OWNED BY     o   ALTER SEQUENCE public.id_status_underwriting_seq OWNED BY public.m_status_underwriting.id_status_underwriting;
            public       postgres    false    247            ?            1259    32855    syarat_pertanggungan    TABLE     	  CREATE TABLE public.syarat_pertanggungan (
    id_syarat_pertanggungan bigint NOT NULL,
    maksimal_plafond double precision,
    x_n bigint,
    free_cover double precision,
    tenor_maksimal bigint,
    cbc double precision,
    polis_induk character varying,
    sertifikat_deklarasi bigint,
    pks character varying,
    brokerage double precision,
    cash_back double precision,
    company_profile bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_dokumen_asuransi bigint
);
 (   DROP TABLE public.syarat_pertanggungan;
       public         postgres    false            ?            1259    32861    id_syarat_per_seq    SEQUENCE     z   CREATE SEQUENCE public.id_syarat_per_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.id_syarat_per_seq;
       public       postgres    false    236                       0    0    id_syarat_per_seq    SEQUENCE OWNED BY     f   ALTER SEQUENCE public.id_syarat_per_seq OWNED BY public.syarat_pertanggungan.id_syarat_pertanggungan;
            public       postgres    false    237            ?            1259    32800    m_tarif_permasa    TABLE     ?   CREATE TABLE public.m_tarif_permasa (
    id_tarif_permasa smallint NOT NULL,
    masa_tahun integer,
    tarif double precision,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_asuransi smallint
);
 #   DROP TABLE public.m_tarif_permasa;
       public         postgres    false            ?            1259    32806    id_tarif_permasa_seq    SEQUENCE     }   CREATE SEQUENCE public.id_tarif_permasa_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.id_tarif_permasa_seq;
       public       postgres    false    226                       0    0    id_tarif_permasa_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.id_tarif_permasa_seq OWNED BY public.m_tarif_permasa.id_tarif_permasa;
            public       postgres    false    227            ?            1259    32809    tr_tarif_perusia    TABLE       CREATE TABLE public.tr_tarif_perusia (
    id_tarif_perusia smallint NOT NULL,
    usia integer,
    masa_tahun integer,
    tarif real,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_asuransi smallint,
    kode_tarif_perusia character varying(100)
);
 $   DROP TABLE public.tr_tarif_perusia;
       public         postgres    false            ?            1259    32815    id_tarif_perusia_seq    SEQUENCE     }   CREATE SEQUENCE public.id_tarif_perusia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.id_tarif_perusia_seq;
       public       postgres    false    228                       0    0    id_tarif_perusia_seq    SEQUENCE OWNED BY     ^   ALTER SEQUENCE public.id_tarif_perusia_seq OWNED BY public.tr_tarif_perusia.id_tarif_perusia;
            public       postgres    false    229            ?            1259    32929    tr_dok_underwriting    TABLE     ?   CREATE TABLE public.tr_dok_underwriting (
    id_tr_dok_underwriting bigint NOT NULL,
    id_dok_underwriting bigint,
    id_status_underwriting bigint,
    add_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_asuransi bigint
);
 '   DROP TABLE public.tr_dok_underwriting;
       public         postgres    false            ?            1259    32935    id_tr_dok_underwriting_seq    SEQUENCE     ?   CREATE SEQUENCE public.id_tr_dok_underwriting_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.id_tr_dok_underwriting_seq;
       public       postgres    false    250                       0    0    id_tr_dok_underwriting_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.id_tr_dok_underwriting_seq OWNED BY public.tr_dok_underwriting.id_tr_dok_underwriting;
            public       postgres    false    251                       1259    33179    tr_jenis_resiko    TABLE       CREATE TABLE public.tr_jenis_resiko (
    id_tr_resiko bigint NOT NULL,
    id_asuransi bigint,
    id_jenis_produk bigint,
    id_jenis_tanggung bigint,
    id_jenis_resiko bigint,
    id_klausul bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 #   DROP TABLE public.tr_jenis_resiko;
       public         postgres    false                       1259    33185    id_tr_resiko_seq    SEQUENCE     y   CREATE SEQUENCE public.id_tr_resiko_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.id_tr_resiko_seq;
       public       postgres    false    274                       0    0    id_tr_resiko_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.id_tr_resiko_seq OWNED BY public.tr_jenis_resiko.id_tr_resiko;
            public       postgres    false    275            ?            1259    32818    tr_underwriting    TABLE     0  CREATE TABLE public.tr_underwriting (
    id_underwriting smallint NOT NULL,
    id_plafond bigint,
    id_usia_masuk bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    id_status_underwriting bigint,
    kode_underwriting character varying(100),
    id_asuransi bigint
);
 #   DROP TABLE public.tr_underwriting;
       public         postgres    false            ?            1259    32824    id_underwriting_seq    SEQUENCE     |   CREATE SEQUENCE public.id_underwriting_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.id_underwriting_seq;
       public       postgres    false    230                       0    0    id_underwriting_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.id_underwriting_seq OWNED BY public.tr_underwriting.id_underwriting;
            public       postgres    false    231            ?            1259    17876    m_user    TABLE     L  CREATE TABLE public.m_user (
    id_user bigint NOT NULL,
    username character varying(255),
    sha character varying(255),
    id_bpr bigint,
    id_level bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    nama_pic character varying(255),
    id_asuransi bigint,
    status smallint DEFAULT 1
);
    DROP TABLE public.m_user;
       public         postgres    false            ?            1259    17905    id_user_seq    SEQUENCE     t   CREATE SEQUENCE public.id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.id_user_seq;
       public       postgres    false    206                       0    0    id_user_seq    SEQUENCE OWNED BY     B   ALTER SEQUENCE public.id_user_seq OWNED BY public.m_user.id_user;
            public       postgres    false    216            ?            1259    32894    m_usia_masuk    TABLE     ?   CREATE TABLE public.m_usia_masuk (
    id_usia_masuk bigint NOT NULL,
    usia_masuk character varying(255),
    add_time timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    usia_masuk_awal bigint,
    usia_masuk_akhir bigint
);
     DROP TABLE public.m_usia_masuk;
       public         postgres    false            ?            1259    32900    id_usia_masuk_seq    SEQUENCE     z   CREATE SEQUENCE public.id_usia_masuk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.id_usia_masuk_seq;
       public       postgres    false    244                       0    0    id_usia_masuk_seq    SEQUENCE OWNED BY     T   ALTER SEQUENCE public.id_usia_masuk_seq OWNED BY public.m_usia_masuk.id_usia_masuk;
            public       postgres    false    245            ?            1259    17868    m_verifikator    TABLE     !  CREATE TABLE public.m_verifikator (
    id_verifikator bigint NOT NULL,
    nama_lengkap character varying(255),
    nik character varying(100),
    alamat text,
    kontak character varying(100),
    id_bpr bigint,
    add_time timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP
);
 !   DROP TABLE public.m_verifikator;
       public         postgres    false            ?            1259    17907    id_verifikator_seq    SEQUENCE     {   CREATE SEQUENCE public.id_verifikator_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.id_verifikator_seq;
       public       postgres    false    205                       0    0    id_verifikator_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.id_verifikator_seq OWNED BY public.m_verifikator.id_verifikator;
            public       postgres    false    217            ?           2604    17979    dokumen id_dokumen    DEFAULT     p   ALTER TABLE ONLY public.dokumen ALTER COLUMN id_dokumen SET DEFAULT nextval('public.id_dokumen_seq'::regclass);
 A   ALTER TABLE public.dokumen ALTER COLUMN id_dokumen DROP DEFAULT;
       public       postgres    false    223    222            ?           2604    33050 $   dokumen_asuransi id_dokumen_asuransi    DEFAULT     ?   ALTER TABLE ONLY public.dokumen_asuransi ALTER COLUMN id_dokumen_asuransi SET DEFAULT nextval('public.id_dokumen_asuransi_seq'::regclass);
 S   ALTER TABLE public.dokumen_asuransi ALTER COLUMN id_dokumen_asuransi DROP DEFAULT;
       public       postgres    false    267    266            ?           2604    33094    dokumen_cbc id_dokumen_cbc    DEFAULT     |   ALTER TABLE ONLY public.dokumen_cbc ALTER COLUMN id_dokumen_cbc SET DEFAULT nextval('public.id_dokumen_cbc_seq'::regclass);
 I   ALTER TABLE public.dokumen_cbc ALTER COLUMN id_dokumen_cbc DROP DEFAULT;
       public       postgres    false    269    268            ?           2604    32884 $   kriteria_peserta id_kriteria_peserta    DEFAULT     ?   ALTER TABLE ONLY public.kriteria_peserta ALTER COLUMN id_kriteria_peserta SET DEFAULT nextval('public.id_kriteria_peserta_seq'::regclass);
 S   ALTER TABLE public.kriteria_peserta ALTER COLUMN id_kriteria_peserta DROP DEFAULT;
       public       postgres    false    241    240            ?           2604    32842    m_asuransi id_asuransi    DEFAULT     u   ALTER TABLE ONLY public.m_asuransi ALTER COLUMN id_asuransi SET DEFAULT nextval('public.id_asuransi_seq'::regclass);
 E   ALTER TABLE public.m_asuransi ALTER COLUMN id_asuransi DROP DEFAULT;
       public       postgres    false    233    232            ?           2604    17909    m_bpr id_bpr    DEFAULT     f   ALTER TABLE ONLY public.m_bpr ALTER COLUMN id_bpr SET DEFAULT nextval('public.id_bpr_seq'::regclass);
 ;   ALTER TABLE public.m_bpr ALTER COLUMN id_bpr DROP DEFAULT;
       public       postgres    false    208    202            ?           2604    17911    m_debitur id_debitur    DEFAULT     r   ALTER TABLE ONLY public.m_debitur ALTER COLUMN id_debitur SET DEFAULT nextval('public.id_debitur_seq'::regclass);
 C   ALTER TABLE public.m_debitur ALTER COLUMN id_debitur DROP DEFAULT;
       public       postgres    false    209    204            ?           2604    32928 &   m_dok_underwriting id_dok_underwriting    DEFAULT     ?   ALTER TABLE ONLY public.m_dok_underwriting ALTER COLUMN id_dok_underwriting SET DEFAULT nextval('public.id_dok_underwriting_seq'::regclass);
 U   ALTER TABLE public.m_dok_underwriting ALTER COLUMN id_dok_underwriting DROP DEFAULT;
       public       postgres    false    249    248            ?           2604    32872     m_jenis_jaminan id_jenis_jaminan    DEFAULT     ?   ALTER TABLE ONLY public.m_jenis_jaminan ALTER COLUMN id_jenis_jaminan SET DEFAULT nextval('public.id_jenis_jaminan_seq'::regclass);
 O   ALTER TABLE public.m_jenis_jaminan ALTER COLUMN id_jenis_jaminan DROP DEFAULT;
       public       postgres    false    239    238            ?           2604    17913    m_jenis_kredit id_jenis_kredit    DEFAULT     ?   ALTER TABLE ONLY public.m_jenis_kredit ALTER COLUMN id_jenis_kredit SET DEFAULT nextval('public.id_jenis_kredit_seq'::regclass);
 M   ALTER TABLE public.m_jenis_kredit ALTER COLUMN id_jenis_kredit DROP DEFAULT;
       public       postgres    false    210    200            ?           2604    33103    m_jenis_produk id_jenis_produk    DEFAULT     ?   ALTER TABLE ONLY public.m_jenis_produk ALTER COLUMN id_jenis_produk SET DEFAULT nextval('public.id_jenis_produk_seq'::regclass);
 M   ALTER TABLE public.m_jenis_produk ALTER COLUMN id_jenis_produk DROP DEFAULT;
       public       postgres    false    271    270            ?           2604    33112    m_jenis_resiko id_jenis_resiko    DEFAULT     ?   ALTER TABLE ONLY public.m_jenis_resiko ALTER COLUMN id_jenis_resiko SET DEFAULT nextval('public.id_jenis_resiko_seq'::regclass);
 M   ALTER TABLE public.m_jenis_resiko ALTER COLUMN id_jenis_resiko DROP DEFAULT;
       public       postgres    false    273    272            ?           2604    17915 "   m_jenis_tanggung id_jenis_tanggung    DEFAULT     ?   ALTER TABLE ONLY public.m_jenis_tanggung ALTER COLUMN id_jenis_tanggung SET DEFAULT nextval('public.id_jenis_pertanggungan_seq'::regclass);
 Q   ALTER TABLE public.m_jenis_tanggung ALTER COLUMN id_jenis_tanggung DROP DEFAULT;
       public       postgres    false    211    201            ~           2604    17917    m_kecamatan id_kecamatan    DEFAULT     x   ALTER TABLE ONLY public.m_kecamatan ALTER COLUMN id_kecamatan SET DEFAULT nextval('public.id_kecamatan_seq'::regclass);
 G   ALTER TABLE public.m_kecamatan ALTER COLUMN id_kecamatan DROP DEFAULT;
       public       postgres    false    212    199            |           2604    17919    m_kota_kab id_kota_kab    DEFAULT     u   ALTER TABLE ONLY public.m_kota_kab ALTER COLUMN id_kota_kab SET DEFAULT nextval('public.id_kota_kab_seq'::regclass);
 E   ALTER TABLE public.m_kota_kab ALTER COLUMN id_kota_kab DROP DEFAULT;
       public       postgres    false    213    198            ?           2604    32771    m_level id_level    DEFAULT     l   ALTER TABLE ONLY public.m_level ALTER COLUMN id_level SET DEFAULT nextval('public.id_level_seq'::regclass);
 ?   ALTER TABLE public.m_level ALTER COLUMN id_level DROP DEFAULT;
       public       postgres    false    225    224            y           2604    17890    m_negara id_negara    DEFAULT     o   ALTER TABLE ONLY public.m_negara ALTER COLUMN id_negara SET DEFAULT nextval('public.id_negara_seq'::regclass);
 A   ALTER TABLE public.m_negara ALTER COLUMN id_negara DROP DEFAULT;
       public       postgres    false    207    196            ?           2604    32893    m_plafond id_plafond    DEFAULT     r   ALTER TABLE ONLY public.m_plafond ALTER COLUMN id_plafond SET DEFAULT nextval('public.id_plafond_seq'::regclass);
 C   ALTER TABLE public.m_plafond ALTER COLUMN id_plafond DROP DEFAULT;
       public       postgres    false    243    242            z           2604    17921    m_provinsi id_provinsi    DEFAULT     u   ALTER TABLE ONLY public.m_provinsi ALTER COLUMN id_provinsi SET DEFAULT nextval('public.id_provinsi_seq'::regclass);
 E   ALTER TABLE public.m_provinsi ALTER COLUMN id_provinsi DROP DEFAULT;
       public       postgres    false    214    197            ?           2604    17941    m_range_bpr id_range_bpr    DEFAULT     x   ALTER TABLE ONLY public.m_range_bpr ALTER COLUMN id_range_bpr SET DEFAULT nextval('public.id_range_bpr_seq'::regclass);
 G   ALTER TABLE public.m_range_bpr ALTER COLUMN id_range_bpr DROP DEFAULT;
       public       postgres    false    219    218            ?           2604    17924    m_spk id_spk    DEFAULT     f   ALTER TABLE ONLY public.m_spk ALTER COLUMN id_spk SET DEFAULT nextval('public.id_spk_seq'::regclass);
 ;   ALTER TABLE public.m_spk ALTER COLUMN id_spk DROP DEFAULT;
       public       postgres    false    215    203            ?           2604    32991    m_status_cash id_status_cash    DEFAULT     ~   ALTER TABLE ONLY public.m_status_cash ALTER COLUMN id_status_cash SET DEFAULT nextval('public.id_status_cash_seq'::regclass);
 K   ALTER TABLE public.m_status_cash ALTER COLUMN id_status_cash DROP DEFAULT;
       public       postgres    false    259    258            ?           2604    33003 2   m_status_lengkap_dokumen id_status_lengkap_dokumen    DEFAULT     ?   ALTER TABLE ONLY public.m_status_lengkap_dokumen ALTER COLUMN id_status_lengkap_dokumen SET DEFAULT nextval('public.id_status_lengkap_dokumen_seq'::regclass);
 a   ALTER TABLE public.m_status_lengkap_dokumen ALTER COLUMN id_status_lengkap_dokumen DROP DEFAULT;
       public       postgres    false    261    260            ?           2604    33012     m_status_polish id_status_polish    DEFAULT     ?   ALTER TABLE ONLY public.m_status_polish ALTER COLUMN id_status_polish SET DEFAULT nextval('public.id_status_polish_seq'::regclass);
 O   ALTER TABLE public.m_status_polish ALTER COLUMN id_status_polish DROP DEFAULT;
       public       postgres    false    263    262            ?           2604    33021 *   m_status_tertanggung id_status_tertanggung    DEFAULT     ?   ALTER TABLE ONLY public.m_status_tertanggung ALTER COLUMN id_status_tertanggung SET DEFAULT nextval('public.id_status_tertanggung_seq'::regclass);
 Y   ALTER TABLE public.m_status_tertanggung ALTER COLUMN id_status_tertanggung DROP DEFAULT;
       public       postgres    false    265    264            ?           2604    32915 ,   m_status_underwriting id_status_underwriting    DEFAULT     ?   ALTER TABLE ONLY public.m_status_underwriting ALTER COLUMN id_status_underwriting SET DEFAULT nextval('public.id_status_underwriting_seq'::regclass);
 [   ALTER TABLE public.m_status_underwriting ALTER COLUMN id_status_underwriting DROP DEFAULT;
       public       postgres    false    247    246            ?           2604    32808     m_tarif_permasa id_tarif_permasa    DEFAULT     ?   ALTER TABLE ONLY public.m_tarif_permasa ALTER COLUMN id_tarif_permasa SET DEFAULT nextval('public.id_tarif_permasa_seq'::regclass);
 O   ALTER TABLE public.m_tarif_permasa ALTER COLUMN id_tarif_permasa DROP DEFAULT;
       public       postgres    false    227    226            ?           2604    17926    m_user id_user    DEFAULT     i   ALTER TABLE ONLY public.m_user ALTER COLUMN id_user SET DEFAULT nextval('public.id_user_seq'::regclass);
 =   ALTER TABLE public.m_user ALTER COLUMN id_user DROP DEFAULT;
       public       postgres    false    216    206            ?           2604    32902    m_usia_masuk id_usia_masuk    DEFAULT     {   ALTER TABLE ONLY public.m_usia_masuk ALTER COLUMN id_usia_masuk SET DEFAULT nextval('public.id_usia_masuk_seq'::regclass);
 I   ALTER TABLE public.m_usia_masuk ALTER COLUMN id_usia_masuk DROP DEFAULT;
       public       postgres    false    245    244            ?           2604    17928    m_verifikator id_verifikator    DEFAULT     ~   ALTER TABLE ONLY public.m_verifikator ALTER COLUMN id_verifikator SET DEFAULT nextval('public.id_verifikator_seq'::regclass);
 K   ALTER TABLE public.m_verifikator ALTER COLUMN id_verifikator DROP DEFAULT;
       public       postgres    false    217    205            ?           2604    17967    pertanggungan id_pertanggungan    DEFAULT     ?   ALTER TABLE ONLY public.pertanggungan ALTER COLUMN id_pertanggungan SET DEFAULT nextval('public.id_pertanggungan_seq'::regclass);
 M   ALTER TABLE public.pertanggungan ALTER COLUMN id_pertanggungan DROP DEFAULT;
       public       postgres    false    221    220            ?           2604    32863 ,   syarat_pertanggungan id_syarat_pertanggungan    DEFAULT     ?   ALTER TABLE ONLY public.syarat_pertanggungan ALTER COLUMN id_syarat_pertanggungan SET DEFAULT nextval('public.id_syarat_per_seq'::regclass);
 [   ALTER TABLE public.syarat_pertanggungan ALTER COLUMN id_syarat_pertanggungan DROP DEFAULT;
       public       postgres    false    237    236            ?           2604    32937 *   tr_dok_underwriting id_tr_dok_underwriting    DEFAULT     ?   ALTER TABLE ONLY public.tr_dok_underwriting ALTER COLUMN id_tr_dok_underwriting SET DEFAULT nextval('public.id_tr_dok_underwriting_seq'::regclass);
 Y   ALTER TABLE public.tr_dok_underwriting ALTER COLUMN id_tr_dok_underwriting DROP DEFAULT;
       public       postgres    false    251    250            ?           2604    33187    tr_jenis_resiko id_tr_resiko    DEFAULT     |   ALTER TABLE ONLY public.tr_jenis_resiko ALTER COLUMN id_tr_resiko SET DEFAULT nextval('public.id_tr_resiko_seq'::regclass);
 K   ALTER TABLE public.tr_jenis_resiko ALTER COLUMN id_tr_resiko DROP DEFAULT;
       public       postgres    false    275    274            ?           2604    32854    tr_klausul id_klausul    DEFAULT     s   ALTER TABLE ONLY public.tr_klausul ALTER COLUMN id_klausul SET DEFAULT nextval('public.id_klausul_seq'::regclass);
 D   ALTER TABLE public.tr_klausul ALTER COLUMN id_klausul DROP DEFAULT;
       public       postgres    false    235    234            ?           2604    32952    tr_penawaran id_penawaran    DEFAULT     y   ALTER TABLE ONLY public.tr_penawaran ALTER COLUMN id_penawaran SET DEFAULT nextval('public.id_penawaran_seq'::regclass);
 H   ALTER TABLE public.tr_penawaran ALTER COLUMN id_penawaran DROP DEFAULT;
       public       postgres    false    253    252            ?           2604    32961    tr_pks id_pks    DEFAULT     g   ALTER TABLE ONLY public.tr_pks ALTER COLUMN id_pks SET DEFAULT nextval('public.id_pks_seq'::regclass);
 <   ALTER TABLE public.tr_pks ALTER COLUMN id_pks DROP DEFAULT;
       public       postgres    false    255    254            ?           2604    33262    tr_resiko_ptg id_resiko_ptg    DEFAULT     |   ALTER TABLE ONLY public.tr_resiko_ptg ALTER COLUMN id_resiko_ptg SET DEFAULT nextval('public.id_resiko_ptg_seq'::regclass);
 J   ALTER TABLE public.tr_resiko_ptg ALTER COLUMN id_resiko_ptg DROP DEFAULT;
       public       postgres    false    277    276            ?           2604    32971    tr_soc id_soc    DEFAULT     g   ALTER TABLE ONLY public.tr_soc ALTER COLUMN id_soc SET DEFAULT nextval('public.id_soc_seq'::regclass);
 <   ALTER TABLE public.tr_soc ALTER COLUMN id_soc DROP DEFAULT;
       public       postgres    false    257    256            ?           2604    32817 !   tr_tarif_perusia id_tarif_perusia    DEFAULT     ?   ALTER TABLE ONLY public.tr_tarif_perusia ALTER COLUMN id_tarif_perusia SET DEFAULT nextval('public.id_tarif_perusia_seq'::regclass);
 P   ALTER TABLE public.tr_tarif_perusia ALTER COLUMN id_tarif_perusia DROP DEFAULT;
       public       postgres    false    229    228            ?           2604    32826    tr_underwriting id_underwriting    DEFAULT     ?   ALTER TABLE ONLY public.tr_underwriting ALTER COLUMN id_underwriting SET DEFAULT nextval('public.id_underwriting_seq'::regclass);
 N   ALTER TABLE public.tr_underwriting ALTER COLUMN id_underwriting DROP DEFAULT;
       public       postgres    false    231    230            ?          0    17969    dokumen 
   TABLE DATA               o   COPY public.dokumen (id_dokumen, nama_dokumen, dokumen, add_time, id_pertanggungan, flag_validasi) FROM stdin;
    public       postgres    false    222   2d      ?          0    33042    dokumen_asuransi 
   TABLE DATA                  COPY public.dokumen_asuransi (id_dokumen_asuransi, nama_dokumen, id_syarat_pertanggungan, add_time, jenis_dokumen) FROM stdin;
    public       postgres    false    266   f      ?          0    33086    dokumen_cbc 
   TABLE DATA               {   COPY public.dokumen_cbc (id_dokumen_cbc, dokumen, id_dok_underwriting, flag_validasi, id_resiko_ptg, add_time) FROM stdin;
    public       postgres    false    268   1g      ?          0    32873    kriteria_peserta 
   TABLE DATA                 COPY public.kriteria_peserta (id_kriteria_peserta, id_jenis_kredit, no_perjanjian_kredit, nama, jenis_kelamin, no_identitas, tanggal_lahir, alamat, plafond_kredit, jangka_waktu_tenor, tgl_mulai_kredit, tgl_berakhir_kredit, rate, jaminan, id_jenis_jaminan, add_time, premi) FROM stdin;
    public       postgres    false    240   ?g      ?          0    32831 
   m_asuransi 
   TABLE DATA               p   COPY public.m_asuransi (id_asuransi, nama_asuransi, alamat, email, no_telepon, add_time, singkatan) FROM stdin;
    public       postgres    false    232   kh      ?          0    17847    m_bpr 
   TABLE DATA               R   COPY public.m_bpr (id_bpr, nama_bpr, email, kontak, alamat, add_time) FROM stdin;
    public       postgres    false    202   i      ?          0    17860 	   m_debitur 
   TABLE DATA               ?  COPY public.m_debitur (id_debitur, nama_lengkap, jenis_kelamin, tempat_lahir, tgl_lahir, jenis_identitas, no_identitas, status_nikah, warga_negara, agama, alamat_rumah, kode_pos_rumah, alamat_korespondensi, kode_pos_korespondensi, kontak, email, pekerjaan, bagian, alamat_kantor, kode_pos_kantor, tujuan_beli_asuransi, sumber_dana_pembelian, pengahasilan_per_tahun, sumber_dana_penghasilan, id_pks, add_time, nik, negara_wna, sumber_dana_pembelian_lainnya, sumber_dana_penghasilan_lainnya, provinsi_rumah, kota_kab_rumah, kecamatan_rumah, provinsi_korespondensi, kota_kab_korespondensi, kecamatan_korespondensi, provinsi_kantor, kota_kab_kantor, kecamatan_kantor, usia) FROM stdin;
    public       postgres    false    204   ?i      ?          0    32920    m_dok_underwriting 
   TABLE DATA               Z   COPY public.m_dok_underwriting (id_dok_underwriting, jenis_dokumen, add_time) FROM stdin;
    public       postgres    false    248   l      ?          0    32864    m_jenis_jaminan 
   TABLE DATA               T   COPY public.m_jenis_jaminan (id_jenis_jaminan, jenis_jaminan, add_time) FROM stdin;
    public       postgres    false    238   nl      ?          0    17837    m_jenis_kredit 
   TABLE DATA               Q   COPY public.m_jenis_kredit (id_jenis_kredit, jenis_kredit, add_time) FROM stdin;
    public       postgres    false    200   ?l      ?          0    33095    m_jenis_produk 
   TABLE DATA               Q   COPY public.m_jenis_produk (id_jenis_produk, jenis_produk, add_time) FROM stdin;
    public       postgres    false    270   ?l      ?          0    33104    m_jenis_resiko 
   TABLE DATA               b   COPY public.m_jenis_resiko (id_jenis_resiko, jenis_resiko, add_time, tampil_otomatis) FROM stdin;
    public       postgres    false    272   Gm      ?          0    17842    m_jenis_tanggung 
   TABLE DATA               W   COPY public.m_jenis_tanggung (id_jenis_tanggung, jenis_tanggung, add_time) FROM stdin;
    public       postgres    false    201   ?m      ?          0    17832    m_kecamatan 
   TABLE DATA               Z   COPY public.m_kecamatan (id_kecamatan, nama_kecamatan, id_kota_kab, add_time) FROM stdin;
    public       postgres    false    199   
n      ?          0    17827 
   m_kota_kab 
   TABLE DATA               W   COPY public.m_kota_kab (id_kota_kab, nama_kota_kab, id_provinsi, add_time) FROM stdin;
    public       postgres    false    198   ln      ?          0    32762    m_level 
   TABLE DATA               >   COPY public.m_level (id_level, level, created_at) FROM stdin;
    public       postgres    false    224   ?n      ?          0    17817    m_negara 
   TABLE DATA               D   COPY public.m_negara (id_negara, nama_negara, add_time) FROM stdin;
    public       postgres    false    196   :o      ?          0    32885 	   m_plafond 
   TABLE DATA               _   COPY public.m_plafond (id_plafond, plafond, add_time, plafond_awal, plafond_akhir) FROM stdin;
    public       postgres    false    242   wo      ?          0    17822 
   m_provinsi 
   TABLE DATA               U   COPY public.m_provinsi (id_provinsi, nama_provinsi, id_negara, add_time) FROM stdin;
    public       postgres    false    197   ?o      ?          0    17934    m_range_bpr 
   TABLE DATA               ^   COPY public.m_range_bpr (id_range_bpr, range_penghasilan_tahun, id_bpr, add_time) FROM stdin;
    public       postgres    false    218   6p      ?          0    17855    m_spk 
   TABLE DATA               Z   COPY public.m_spk (id_spk, no_spk, tgl_mulai, tgl_berakhir, add_time, id_bpr) FROM stdin;
    public       postgres    false    203   ?p      ?          0    32983    m_status_cash 
   TABLE DATA               N   COPY public.m_status_cash (id_status_cash, status_cash, add_time) FROM stdin;
    public       postgres    false    258   ?p      ?          0    32992    m_status_lengkap_dokumen 
   TABLE DATA               o   COPY public.m_status_lengkap_dokumen (id_status_lengkap_dokumen, status_lengkap_dokumen, add_time) FROM stdin;
    public       postgres    false    260   %q      ?          0    33004    m_status_polish 
   TABLE DATA               T   COPY public.m_status_polish (id_status_polish, status_polish, add_time) FROM stdin;
    public       postgres    false    262   xq      ?          0    33013    m_status_tertanggung 
   TABLE DATA               c   COPY public.m_status_tertanggung (id_status_tertanggung, status_tertanggung, add_time) FROM stdin;
    public       postgres    false    264   ?q      ?          0    32907    m_status_underwriting 
   TABLE DATA               f   COPY public.m_status_underwriting (id_status_underwriting, status_underwriting, add_time) FROM stdin;
    public       postgres    false    246   r      ?          0    32800    m_tarif_permasa 
   TABLE DATA               e   COPY public.m_tarif_permasa (id_tarif_permasa, masa_tahun, tarif, add_time, id_asuransi) FROM stdin;
    public       postgres    false    226   ?r      ?          0    17876    m_user 
   TABLE DATA               s   COPY public.m_user (id_user, username, sha, id_bpr, id_level, add_time, nama_pic, id_asuransi, status) FROM stdin;
    public       postgres    false    206   ?r      ?          0    32894    m_usia_masuk 
   TABLE DATA               n   COPY public.m_usia_masuk (id_usia_masuk, usia_masuk, add_time, usia_masuk_awal, usia_masuk_akhir) FROM stdin;
    public       postgres    false    244   ?s      ?          0    17868    m_verifikator 
   TABLE DATA               l   COPY public.m_verifikator (id_verifikator, nama_lengkap, nik, alamat, kontak, id_bpr, add_time) FROM stdin;
    public       postgres    false    205   ?s      ?          0    17957    pertanggungan 
   TABLE DATA               ?  COPY public.pertanggungan (id_pertanggungan, id_debitur, cara_bayar, kredit_bank, ahli_waris, hubungan_ahli_waris, tanya_data_asuransi, tanya_data_asuransi_jelaskan, tinggi_badan, berat_badan, tanya_kesehatan_1, tanya_kesehatan_2, tanya_kesehatan_3, tanya_hamil, hamil_anak_ke, add_time, kode_tertanggung, id_status_lengkap_dokumen, id_status_polish, id_status_tertanggung, tanya_kesehatan_1_sts, tanya_kesehatan_2_sts, tanya_kesehatan_3_sts, forward_asuransi) FROM stdin;
    public       postgres    false    220   t      ?          0    32855    syarat_pertanggungan 
   TABLE DATA               ?   COPY public.syarat_pertanggungan (id_syarat_pertanggungan, maksimal_plafond, x_n, free_cover, tenor_maksimal, cbc, polis_induk, sertifikat_deklarasi, pks, brokerage, cash_back, company_profile, add_time, id_dokumen_asuransi) FROM stdin;
    public       postgres    false    236   ct      ?          0    32929    tr_dok_underwriting 
   TABLE DATA               ?   COPY public.tr_dok_underwriting (id_tr_dok_underwriting, id_dok_underwriting, id_status_underwriting, add_time, id_asuransi) FROM stdin;
    public       postgres    false    250   u      ?          0    33179    tr_jenis_resiko 
   TABLE DATA               ?   COPY public.tr_jenis_resiko (id_tr_resiko, id_asuransi, id_jenis_produk, id_jenis_tanggung, id_jenis_resiko, id_klausul, add_time) FROM stdin;
    public       postgres    false    274   gu      ?          0    32843 
   tr_klausul 
   TABLE DATA               ?   COPY public.tr_klausul (id_klausul, id_asuransi, id_syarat_pertanggungan, kode_underwriting, kode_tarif_perusia, add_time, kode_klausul) FROM stdin;
    public       postgres    false    234   ?u      ?          0    32944    tr_penawaran 
   TABLE DATA               ?   COPY public.tr_penawaran (id_penawaran, nomor_penawaran, id_bpr, kode_klausul, status, dokumen, add_time, id_asuransi) FROM stdin;
    public       postgres    false    252   Iv      ?          0    32953    tr_pks 
   TABLE DATA               S   COPY public.tr_pks (id_pks, nomor_pks, id_soc, add_time, id_penawaran) FROM stdin;
    public       postgres    false    254   ?v      ?          0    33254    tr_resiko_ptg 
   TABLE DATA               ,  COPY public.tr_resiko_ptg (id_resiko_ptg, id_debitur, id_jenis_kredit, id_jenis_tanggung, id_jenis_resiko, uang_ptg, bunga, tgl_akad, periode_asuransi_awal, periode_asuransi_akhir, masa_asuransi, id_status_cash, premi, id_status_underwriting, add_time, kode_tertanggung, id_jenis_produk) FROM stdin;
    public       postgres    false    276   
w      ?          0    32962    tr_soc 
   TABLE DATA               ?   COPY public.tr_soc (id_soc, soc, komisi_agent, feebase, overiding, komisi_net_broker, net_fee_broker, add_time, id_bpr, jumlah_detail_soc) FROM stdin;
    public       postgres    false    256   hw      ?          0    32809    tr_tarif_perusia 
   TABLE DATA               ?   COPY public.tr_tarif_perusia (id_tarif_perusia, usia, masa_tahun, tarif, add_time, id_asuransi, kode_tarif_perusia) FROM stdin;
    public       postgres    false    228   ?w      ?          0    32818    tr_underwriting 
   TABLE DATA               ?   COPY public.tr_underwriting (id_underwriting, id_plafond, id_usia_masuk, add_time, id_status_underwriting, kode_underwriting, id_asuransi) FROM stdin;
    public       postgres    false    230   L?                 0    0    id_asuransi_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.id_asuransi_seq', 7, true);
            public       postgres    false    233                       0    0 
   id_bpr_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('public.id_bpr_seq', 3, true);
            public       postgres    false    208                       0    0    id_debitur_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.id_debitur_seq', 39, true);
            public       postgres    false    209                       0    0    id_dok_underwriting_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.id_dok_underwriting_seq', 8, true);
            public       postgres    false    249                       0    0    id_dokumen_asuransi_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.id_dokumen_asuransi_seq', 208, true);
            public       postgres    false    267                       0    0    id_dokumen_cbc_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.id_dokumen_cbc_seq', 12, true);
            public       postgres    false    269                        0    0    id_dokumen_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.id_dokumen_seq', 156, true);
            public       postgres    false    223            !           0    0    id_jenis_jaminan_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.id_jenis_jaminan_seq', 1, true);
            public       postgres    false    239            "           0    0    id_jenis_kredit_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.id_jenis_kredit_seq', 6, true);
            public       postgres    false    210            #           0    0    id_jenis_pertanggungan_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.id_jenis_pertanggungan_seq', 6, true);
            public       postgres    false    211            $           0    0    id_jenis_produk_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.id_jenis_produk_seq', 3, true);
            public       postgres    false    271            %           0    0    id_jenis_resiko_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.id_jenis_resiko_seq', 5, true);
            public       postgres    false    273            &           0    0    id_kecamatan_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.id_kecamatan_seq', 11, true);
            public       postgres    false    212            '           0    0    id_klausul_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.id_klausul_seq', 61, true);
            public       postgres    false    235            (           0    0    id_kota_kab_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.id_kota_kab_seq', 7, true);
            public       postgres    false    213            )           0    0    id_kriteria_peserta_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.id_kriteria_peserta_seq', 1, true);
            public       postgres    false    241            *           0    0    id_level_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.id_level_seq', 4, true);
            public       postgres    false    225            +           0    0    id_negara_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.id_negara_seq', 7, true);
            public       postgres    false    207            ,           0    0    id_penawaran_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.id_penawaran_seq', 7, true);
            public       postgres    false    253            -           0    0    id_pertanggungan_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.id_pertanggungan_seq', 73, true);
            public       postgres    false    221            .           0    0 
   id_pks_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.id_pks_seq', 13, true);
            public       postgres    false    255            /           0    0    id_plafond_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.id_plafond_seq', 3, true);
            public       postgres    false    243            0           0    0    id_provinsi_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.id_provinsi_seq', 8, true);
            public       postgres    false    214            1           0    0    id_range_bpr_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.id_range_bpr_seq', 3, true);
            public       postgres    false    219            2           0    0    id_resiko_ptg_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.id_resiko_ptg_seq', 14, true);
            public       postgres    false    277            3           0    0 
   id_soc_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.id_soc_seq', 14, true);
            public       postgres    false    257            4           0    0 
   id_spk_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('public.id_spk_seq', 4, true);
            public       postgres    false    215            5           0    0    id_status_cash_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.id_status_cash_seq', 2, true);
            public       postgres    false    259            6           0    0    id_status_lengkap_dokumen_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.id_status_lengkap_dokumen_seq', 3, true);
            public       postgres    false    261            7           0    0    id_status_polish_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.id_status_polish_seq', 3, true);
            public       postgres    false    263            8           0    0    id_status_tertanggung_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.id_status_tertanggung_seq', 2, true);
            public       postgres    false    265            9           0    0    id_status_underwriting_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.id_status_underwriting_seq', 14, true);
            public       postgres    false    247            :           0    0    id_syarat_per_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.id_syarat_per_seq', 65, true);
            public       postgres    false    237            ;           0    0    id_tarif_permasa_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.id_tarif_permasa_seq', 1, false);
            public       postgres    false    227            <           0    0    id_tarif_perusia_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.id_tarif_perusia_seq', 21406, true);
            public       postgres    false    229            =           0    0    id_tr_dok_underwriting_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.id_tr_dok_underwriting_seq', 31, true);
            public       postgres    false    251            >           0    0    id_tr_resiko_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.id_tr_resiko_seq', 18, true);
            public       postgres    false    275            ?           0    0    id_underwriting_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.id_underwriting_seq', 257, true);
            public       postgres    false    231            @           0    0    id_user_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.id_user_seq', 7, true);
            public       postgres    false    216            A           0    0    id_usia_masuk_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.id_usia_masuk_seq', 3, true);
            public       postgres    false    245            B           0    0    id_verifikator_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.id_verifikator_seq', 1, false);
            public       postgres    false    217                       2606    32925 (   m_dok_underwriting dok_underwriting_pkey 
   CONSTRAINT     w   ALTER TABLE ONLY public.m_dok_underwriting
    ADD CONSTRAINT dok_underwriting_pkey PRIMARY KEY (id_dok_underwriting);
 R   ALTER TABLE ONLY public.m_dok_underwriting DROP CONSTRAINT dok_underwriting_pkey;
       public         postgres    false    248                       2606    33047 &   dokumen_asuransi dokumen_asuransi_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY public.dokumen_asuransi
    ADD CONSTRAINT dokumen_asuransi_pkey PRIMARY KEY (id_dokumen_asuransi);
 P   ALTER TABLE ONLY public.dokumen_asuransi DROP CONSTRAINT dokumen_asuransi_pkey;
       public         postgres    false    266                       2606    33091    dokumen_cbc dokumen_cbc_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.dokumen_cbc
    ADD CONSTRAINT dokumen_cbc_pkey PRIMARY KEY (id_dokumen_cbc);
 F   ALTER TABLE ONLY public.dokumen_cbc DROP CONSTRAINT dokumen_cbc_pkey;
       public         postgres    false    268            ?           2606    17976    dokumen dokumen_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.dokumen
    ADD CONSTRAINT dokumen_pkey PRIMARY KEY (id_dokumen);
 >   ALTER TABLE ONLY public.dokumen DROP CONSTRAINT dokumen_pkey;
       public         postgres    false    222                       2606    32939 +   m_status_underwriting isi_underwriting_pkey 
   CONSTRAINT     }   ALTER TABLE ONLY public.m_status_underwriting
    ADD CONSTRAINT isi_underwriting_pkey PRIMARY KEY (id_status_underwriting);
 U   ALTER TABLE ONLY public.m_status_underwriting DROP CONSTRAINT isi_underwriting_pkey;
       public         postgres    false    246            ?           2606    32881 &   kriteria_peserta kriteria_peserta_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY public.kriteria_peserta
    ADD CONSTRAINT kriteria_peserta_pkey PRIMARY KEY (id_kriteria_peserta);
 P   ALTER TABLE ONLY public.kriteria_peserta DROP CONSTRAINT kriteria_peserta_pkey;
       public         postgres    false    240            ?           2606    32839    m_asuransi m_asuransi_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.m_asuransi
    ADD CONSTRAINT m_asuransi_pkey PRIMARY KEY (id_asuransi);
 D   ALTER TABLE ONLY public.m_asuransi DROP CONSTRAINT m_asuransi_pkey;
       public         postgres    false    232            ?           2606    17854    m_bpr m_bpr_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.m_bpr
    ADD CONSTRAINT m_bpr_pkey PRIMARY KEY (id_bpr);
 :   ALTER TABLE ONLY public.m_bpr DROP CONSTRAINT m_bpr_pkey;
       public         postgres    false    202            ?           2606    17867    m_debitur m_debitur_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.m_debitur
    ADD CONSTRAINT m_debitur_pkey PRIMARY KEY (id_debitur);
 B   ALTER TABLE ONLY public.m_debitur DROP CONSTRAINT m_debitur_pkey;
       public         postgres    false    204            ?           2606    32869 $   m_jenis_jaminan m_jenis_jaminan_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.m_jenis_jaminan
    ADD CONSTRAINT m_jenis_jaminan_pkey PRIMARY KEY (id_jenis_jaminan);
 N   ALTER TABLE ONLY public.m_jenis_jaminan DROP CONSTRAINT m_jenis_jaminan_pkey;
       public         postgres    false    238            ?           2606    17841 "   m_jenis_kredit m_jenis_kredit_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.m_jenis_kredit
    ADD CONSTRAINT m_jenis_kredit_pkey PRIMARY KEY (id_jenis_kredit);
 L   ALTER TABLE ONLY public.m_jenis_kredit DROP CONSTRAINT m_jenis_kredit_pkey;
       public         postgres    false    200            ?           2606    17933 +   m_jenis_tanggung m_jenis_pertanggungan_pkey 
   CONSTRAINT     x   ALTER TABLE ONLY public.m_jenis_tanggung
    ADD CONSTRAINT m_jenis_pertanggungan_pkey PRIMARY KEY (id_jenis_tanggung);
 U   ALTER TABLE ONLY public.m_jenis_tanggung DROP CONSTRAINT m_jenis_pertanggungan_pkey;
       public         postgres    false    201                       2606    33100 "   m_jenis_produk m_jenis_produk_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.m_jenis_produk
    ADD CONSTRAINT m_jenis_produk_pkey PRIMARY KEY (id_jenis_produk);
 L   ALTER TABLE ONLY public.m_jenis_produk DROP CONSTRAINT m_jenis_produk_pkey;
       public         postgres    false    270                       2606    33109 "   m_jenis_resiko m_jenis_resiko_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.m_jenis_resiko
    ADD CONSTRAINT m_jenis_resiko_pkey PRIMARY KEY (id_jenis_resiko);
 L   ALTER TABLE ONLY public.m_jenis_resiko DROP CONSTRAINT m_jenis_resiko_pkey;
       public         postgres    false    272            ?           2606    17836    m_kecamatan m_kecamatan_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.m_kecamatan
    ADD CONSTRAINT m_kecamatan_pkey PRIMARY KEY (id_kecamatan);
 F   ALTER TABLE ONLY public.m_kecamatan DROP CONSTRAINT m_kecamatan_pkey;
       public         postgres    false    199            ?           2606    17831    m_kota_kab m_kota_kab_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.m_kota_kab
    ADD CONSTRAINT m_kota_kab_pkey PRIMARY KEY (id_kota_kab);
 D   ALTER TABLE ONLY public.m_kota_kab DROP CONSTRAINT m_kota_kab_pkey;
       public         postgres    false    198            ?           2606    32770    m_level m_level_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.m_level
    ADD CONSTRAINT m_level_pkey PRIMARY KEY (id_level);
 >   ALTER TABLE ONLY public.m_level DROP CONSTRAINT m_level_pkey;
       public         postgres    false    224            ?           2606    17821    m_negara m_negara_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.m_negara
    ADD CONSTRAINT m_negara_pkey PRIMARY KEY (id_negara);
 @   ALTER TABLE ONLY public.m_negara DROP CONSTRAINT m_negara_pkey;
       public         postgres    false    196            ?           2606    32890    m_plafond m_plafond_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.m_plafond
    ADD CONSTRAINT m_plafond_pkey PRIMARY KEY (id_plafond);
 B   ALTER TABLE ONLY public.m_plafond DROP CONSTRAINT m_plafond_pkey;
       public         postgres    false    242            ?           2606    17826    m_provinsi m_provinsi_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.m_provinsi
    ADD CONSTRAINT m_provinsi_pkey PRIMARY KEY (id_provinsi);
 D   ALTER TABLE ONLY public.m_provinsi DROP CONSTRAINT m_provinsi_pkey;
       public         postgres    false    197            ?           2606    17938    m_range_bpr m_range_bpr_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.m_range_bpr
    ADD CONSTRAINT m_range_bpr_pkey PRIMARY KEY (id_range_bpr);
 F   ALTER TABLE ONLY public.m_range_bpr DROP CONSTRAINT m_range_bpr_pkey;
       public         postgres    false    218            ?           2606    17859    m_spk m_spk_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.m_spk
    ADD CONSTRAINT m_spk_pkey PRIMARY KEY (id_spk);
 :   ALTER TABLE ONLY public.m_spk DROP CONSTRAINT m_spk_pkey;
       public         postgres    false    203                       2606    32988     m_status_cash m_status_cash_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.m_status_cash
    ADD CONSTRAINT m_status_cash_pkey PRIMARY KEY (id_status_cash);
 J   ALTER TABLE ONLY public.m_status_cash DROP CONSTRAINT m_status_cash_pkey;
       public         postgres    false    258                       2606    33000 6   m_status_lengkap_dokumen m_status_lengkap_dokumen_pkey 
   CONSTRAINT     ?   ALTER TABLE ONLY public.m_status_lengkap_dokumen
    ADD CONSTRAINT m_status_lengkap_dokumen_pkey PRIMARY KEY (id_status_lengkap_dokumen);
 `   ALTER TABLE ONLY public.m_status_lengkap_dokumen DROP CONSTRAINT m_status_lengkap_dokumen_pkey;
       public         postgres    false    260                       2606    33009 $   m_status_polish m_status_polish_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.m_status_polish
    ADD CONSTRAINT m_status_polish_pkey PRIMARY KEY (id_status_polish);
 N   ALTER TABLE ONLY public.m_status_polish DROP CONSTRAINT m_status_polish_pkey;
       public         postgres    false    262                       2606    33018 .   m_status_tertanggung m_status_tertanggung_pkey 
   CONSTRAINT        ALTER TABLE ONLY public.m_status_tertanggung
    ADD CONSTRAINT m_status_tertanggung_pkey PRIMARY KEY (id_status_tertanggung);
 X   ALTER TABLE ONLY public.m_status_tertanggung DROP CONSTRAINT m_status_tertanggung_pkey;
       public         postgres    false    264            ?           2606    32805 $   m_tarif_permasa m_tarif_permasa_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.m_tarif_permasa
    ADD CONSTRAINT m_tarif_permasa_pkey PRIMARY KEY (id_tarif_permasa);
 N   ALTER TABLE ONLY public.m_tarif_permasa DROP CONSTRAINT m_tarif_permasa_pkey;
       public         postgres    false    226            ?           2606    32814 %   tr_tarif_perusia m_tarif_perusia_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tr_tarif_perusia
    ADD CONSTRAINT m_tarif_perusia_pkey PRIMARY KEY (id_tarif_perusia);
 O   ALTER TABLE ONLY public.tr_tarif_perusia DROP CONSTRAINT m_tarif_perusia_pkey;
       public         postgres    false    228            ?           2606    32823 #   tr_underwriting m_underwriting_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.tr_underwriting
    ADD CONSTRAINT m_underwriting_pkey PRIMARY KEY (id_underwriting);
 M   ALTER TABLE ONLY public.tr_underwriting DROP CONSTRAINT m_underwriting_pkey;
       public         postgres    false    230            ?           2606    17883    m_user m_user_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY public.m_user
    ADD CONSTRAINT m_user_pkey PRIMARY KEY (id_user);
 <   ALTER TABLE ONLY public.m_user DROP CONSTRAINT m_user_pkey;
       public         postgres    false    206            ?           2606    17875     m_verifikator m_verifikator_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.m_verifikator
    ADD CONSTRAINT m_verifikator_pkey PRIMARY KEY (id_verifikator);
 J   ALTER TABLE ONLY public.m_verifikator DROP CONSTRAINT m_verifikator_pkey;
       public         postgres    false    205            ?           2606    17964     pertanggungan pertanggungan_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.pertanggungan
    ADD CONSTRAINT pertanggungan_pkey PRIMARY KEY (id_pertanggungan);
 J   ALTER TABLE ONLY public.pertanggungan DROP CONSTRAINT pertanggungan_pkey;
       public         postgres    false    220            ?           2606    32860 .   syarat_pertanggungan syarat_pertanggungan_pkey 
   CONSTRAINT     ?   ALTER TABLE ONLY public.syarat_pertanggungan
    ADD CONSTRAINT syarat_pertanggungan_pkey PRIMARY KEY (id_syarat_pertanggungan);
 X   ALTER TABLE ONLY public.syarat_pertanggungan DROP CONSTRAINT syarat_pertanggungan_pkey;
       public         postgres    false    236                       2606    32934 ,   tr_dok_underwriting tr_dok_underwriting_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.tr_dok_underwriting
    ADD CONSTRAINT tr_dok_underwriting_pkey PRIMARY KEY (id_tr_dok_underwriting);
 V   ALTER TABLE ONLY public.tr_dok_underwriting DROP CONSTRAINT tr_dok_underwriting_pkey;
       public         postgres    false    250                       2606    33184 $   tr_jenis_resiko tr_jenis_resiko_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.tr_jenis_resiko
    ADD CONSTRAINT tr_jenis_resiko_pkey PRIMARY KEY (id_tr_resiko);
 N   ALTER TABLE ONLY public.tr_jenis_resiko DROP CONSTRAINT tr_jenis_resiko_pkey;
       public         postgres    false    274            ?           2606    32848    tr_klausul tr_klausul_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tr_klausul
    ADD CONSTRAINT tr_klausul_pkey PRIMARY KEY (id_klausul);
 D   ALTER TABLE ONLY public.tr_klausul DROP CONSTRAINT tr_klausul_pkey;
       public         postgres    false    234                       2606    32949    tr_penawaran tr_penawaran_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.tr_penawaran
    ADD CONSTRAINT tr_penawaran_pkey PRIMARY KEY (id_penawaran);
 H   ALTER TABLE ONLY public.tr_penawaran DROP CONSTRAINT tr_penawaran_pkey;
       public         postgres    false    252            	           2606    32958    tr_pks tr_pks_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.tr_pks
    ADD CONSTRAINT tr_pks_pkey PRIMARY KEY (id_pks);
 <   ALTER TABLE ONLY public.tr_pks DROP CONSTRAINT tr_pks_pkey;
       public         postgres    false    254                       2606    33259     tr_resiko_ptg tr_resiko_ptg_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.tr_resiko_ptg
    ADD CONSTRAINT tr_resiko_ptg_pkey PRIMARY KEY (id_resiko_ptg);
 J   ALTER TABLE ONLY public.tr_resiko_ptg DROP CONSTRAINT tr_resiko_ptg_pkey;
       public         postgres    false    276                       2606    32967    tr_soc tr_soc_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.tr_soc
    ADD CONSTRAINT tr_soc_pkey PRIMARY KEY (id_soc);
 <   ALTER TABLE ONLY public.tr_soc DROP CONSTRAINT tr_soc_pkey;
       public         postgres    false    256            ?           2606    32899    m_usia_masuk usia_masuk_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.m_usia_masuk
    ADD CONSTRAINT usia_masuk_pkey PRIMARY KEY (id_usia_masuk);
 F   ALTER TABLE ONLY public.m_usia_masuk DROP CONSTRAINT usia_masuk_pkey;
       public         postgres    false    244            ?   ?  x????N?0???S?@?ױ?xB??"EMBP??^Ӭ??S_?,???EG?9 V?{?։G??|??t?vh?????ֆ???>~l???????m󉍼????WR]I[@? (aJ????Dw???_??mx-:??E?~??a?/?CJ????~??_~h??@V???[???N??艋???t?????.????????n??Ό???_&:+}=ǭ]8,?L\?H?M??So?????M
???+?5j?Q{?*??=M^?uR???A&*+x?0?SZ?j????5??i???̞?fl?X?-??????3??ܑ??J??m?ؐ7?@?,P????rsvv?텆?R;707?Z?ܐ7?H??:??,??	?Y?x??"m????Y????i????$-??????̩E?j????H[-6?m-?2?p???js?v???H[-60?i??^?W??7C??;      ?     x??ӻN?0???y
^??﮳Q????ɲh??I'<?BIA??lߑ~??Ѓ?????֟?`?U[O?.????y?ۛ??ּQ?????$ES??l??Q%%ר?? ?'?$??????#-i
?/ݹ???D?AjSնq??(?УkkoC?v>T~???wa?Wl.??r	_u?Y(4`?M1βd?4??$~&???/?뒩???=? ?Mq??I??$N?@?˸"????H,?`?W??VQB.???Q?ooџ?EQ?(d?/      ?   ?   x?u??
?0??s?????Vmn??1???P???????_=???[?/?B??7?clz??_??Wmyߺ???}?ͳ??m??]???!NgE
?U?1??#2???h???S???E???lR?I?̹???;&Ѕ????v3?[???8J???ߐ䁕?:?Z?Ie      ?   t   x?5?1
?@D??S????n??]?N???f% ?E?????x<xE ????J?????g??xm??f?H
$%z??a?幖?? ??{??1?W~/%???7m?v????s???      ?   ?   x?U̿?0????? ?8ʟv???bB????/Z0??????|÷?ZV??$=??V??c?ؿ??&?????6?FS?)O?R?	???j?v8e?pV?O???] N??D1???H???C͗?#YY]ۢ?????.?R???.?      ?   {   x?=̽
?0????)?-'???c*utgAb?4M|KQ???C???u?t]^???TR~?c-???hH??=O?`4??f??"??M??????m???Vd??A?ǟ???h$vN?[??P$?      ?   m  x???mo?0?__>E? ?????+??X??
ʪJ?&we%%?)!C???<m?kQ7ŊrV??????a?=:?qYrp0t????cE%??f?,ٺM????A=۽6?H??e?6??{tO	0ު=}΢ ?$Ҵ?A??ڐ?1????U?<7%{az}???1?Al???85)}??Q`~Ks#I:x?<?2u??e/;G??9W(PF?꿜??????g?=/*?	???m]??xj/,?C?UY??ŵ0h4?a?N˝??q̒?I??//?~?( jÕ0?hl??3_??]?`??-??,??j?????]P???Ӱ????????H[=O=	?eQ~mZ?ܧ??zS???Ma*?T?????vm?Oi?_????P??????>?E???#ך,)?Q?6xܹ$???????8??Na??6r[??9??????Pn\?SptyRi?Z?y
E?3"?GLu8???D?????Ԭ~q?:!ѡ??:ϟ?M{Xמʠ???e?ӹz?????`SW|?fK?*??P??`p?Ud?F񌐫wsb?vqmɱ"?5??SkR+J??U#k??h~?)i???q?~1?]R<???w?P?3	???r?B?@-usϞ?C???y?O??`      ?   O   x?3???4202?50?50S02?21?2??2?tLI,?A?3?22?24?2?t?Nǔ1??2???/J???46?????? 6?       ?   -   x?3??J???K?S0?4202?50?50W02?21?25?????? ?8?      ?   5   x?3??J??,V?.J5?4202?50?56P04?20".c?#L?F\1z\\\ V?f      ?   G   x?3?I-?U(?O)??4202?50?50T04?2"K.#? Gt	s+K.cN?ļd??bLic3?=... e)      ?   t   x?m?1
?0F?Y:?.? ??C??K)t)?cW&	???P?B????ף45????i"e?\?M?r?e????w?d??x????=??U?z.W0??$?9 ????Z{w???*       ?   /   x?3??4202?50?5?T04?2??22?2??Ŕ06?????? ?	?      ?   R   x???t?LN?K??4?4202?50?56P04?26?21?2?tO?+??4F???2??2?tJ?N,?TpJ,J,?4?Tdj????? ??y      ?   f   x?3?tJ?K)?K?4?4202?50?5?T02?20?2??2?N?M,J*0AQ`deD?\&?!???9H??
?&V??V??\??N?ىřH?C?M?L?b???? ???      ?   H   x?3?t*??N-?4202?50?5?P02?2??2??2?t,.-J?+΄JU????????9???j????? ??1      ?   -   x?3???K??K-?L?4202?50?5?T04?20?21?????? ?2C      ?   \   x?u˱?0?ڞ???????Y25??Q@*???I??'L,???im??G????>m??a2?????%?~????0?(9留?!??      ?   C   x?3??J,OTpJ,J,????4202?50?5?T02?20?2??2??	I?KO?@WddehT????? ???      ?   B   x?3?463 NCN##]S]s+CK+S.#N#
??L,??&?+0?2??????? ?I?      ?   Q   x?3?4202?????u?u?LS??????????)?!?	D'H??kT?	B?????Vs+3+cN#?=... ??U      ?   ,   x?3?tvt?4202?50?5?P0??!C.#Ng'l2?\1z\\\ 0c
=      ?   C   x?3??I?K?N,?4202?50?5?P02?24?2??2?tJ?)?U???ؘ˘SM??????+F??? *?a      ?   L   x?3?I-J?,?4202?50?5?T00?24?2??2???I?Ɣ35?2?t??.?M?SI?MJ?H?â̂+F??? ??      ?   9   x?3?LLNN-(IM?4202?50?5?T00?2?".#΂?⒂??TLi#?=... 6?Y      ?   Z   x?mͻ?0C?ڞ???G?@t0??5??????6??? i2]??0??P?Q??΂m??P{nT?1?Du????j?3?||?#?      ?      x?????? ? ?      ?   ?   x???Mo?@????_Ⴍx?Le?M:~Ĥq3"2(?ʔ??{?F7.]??yr(?Ԫ498?:??a^?BO?F?ڱ?M?n??s?/j??X[-?h??t6>?HO???S6>?#?.?.:$??󯁀????a?I???
??)Zf?d?;?ߩ?x??R?~e???hql?r-gX???? ? <??6?a?W???@???Il\???`T?      ?   W   x?eʹ?@Q?????1%bQ?q,+S???g]{yNa[?5?U??T??yy2?kh??k?J&gE?S?i}?????B?|3? $?#      ?      x?????? ? ?      ?   N   x?33?4????CG???~IfJb6?ad`d?k`?k`?``iehheh??n`a`ldhj?l?i?i ?`????? Z?      ?   ?   x?}?=?0???Sp??ƿ??R	?D??z?s?1!??????gc?(DT???86l??DEǼ?J?c??ll?i?<?<?~?^X?r??	N+?l?b?k?uL?R?`????S?p@?;Xߛ??Z??#???zo?????Rz'L1?      ?   P   x?u???0D?3T?`?P???#??|??/?2rR?4h?=l??NRT??ו?]w????ƆL?(???F?y???^\      ?   P   x?mʱ? C?ښ"??0??,??G?*I???хbko?53?%??1?G?`?"ߢ???j՗(}X?????0O LH?      ?   r   x?e?1?0F??>(???I????`BT,??9*?J?0>???BJ	??oA!???\?*H?A0H?h??j???8"?q
??+ej7W?:+?TdW?{???\???+{?+㏲^?y??+)      ?   Y   x?m?1
?0???~@??MH+ba??.????z?E X?????	??72?}^Ť??e???r?(???????n߶??g??Bm??>Kd<      ?   H   x?34?4000???70?7202?44?Ѻƺ
V&fV@a3.?P??b4Ŧ?VF??\1z\\\ P?,      ?   N   x?3?4??4?4B#( ???u?u,И@??AC?NK$e
?V??V?Ɯ!!??F??&Ζ??\1z\\\ @??      ?   G   x?34?47?44?4B!?u?u,,?L̬?9c?8??M?$H	??1?bSC+?@??\1z\\\ ??      ?      x???Mr-=????W??n??P?{?4????ǡx}??Sy,ᨪF?xn2?q?{?Xc??????????????????G??????_?}??????????????_4??/?~??:z??/?^??Fg!:???y?u?K?g~?y???g}??/??u????&z???Q^????a_???|?}y?(??6?x???W???)<??U???ᩝh~???%<u|??sS???S????rT??>҉?pk?/??$:^??Et??[???????~???xж???mW????m'??`ے?F-??l?Q??{y$G?????5*????i*??n?v?n?]??]T??]4???\t??!?H<??I?<???[_?E???Bj??x???S??K??m???W?f?9r?U??p???}?ȝN?=?;?dw??iuu?%w??@?l??A???S.8???Z?_??586??/??B??vI3?綋?P????o??"4*???I?*5ͫ#5j??f???P??d?l>?]???? ??{p??????q??W'?7}|u??q?ur?q??ju?ZK????j??تȨO??*3*??.N??
?ۄ?|??j??m?[???7:8??ln???L.??N?[?D?????????`??ǧ֫n???L??u????m2]d?.u?L?????B?Rݿ?w???ۈ??C??`?6
?? mT?Ӈ6?u?lt?g6?xP6&???l,???#	?:ȆĨH&?!2??kfʌz䢙B?"?j?o??v??????ύ???g<pc0????o??jc<?U???:D·?Px?M.5f?;??R[	??Ԗ?TK?	???4\3Kf?.????v?????K??o<??U?5?O}?ƀ??̶7?áV]???P?Lo̅Cur?1????p8?'S???'??1??M?5F?A?|k;??k[bh?Kf??Zu}Bf?'M???̫?H??N?7F?Gur?1>???????????????1>_?|n??W&_C?C?\l̄?Zu}????i?$??`?H????9"?>?f??T?.B??i?j??=?????Nlܾ???ﵹ}w?䰹??/{Q?n/i?Fd?ھ?????E$÷߷?^T'?Z???_??EI0զEb?.M?L???4m3Uf(???
?Ju}uxoXU??H'?|h?%????w?U=r??Er???&???? ?}f??Y?+c	K#|d?S??YK0?A?$FE2?4?Q?\3Mf?#M?T?d??Nn0?{n?v????Ə2޻??(/??ύϔE???	n[D·?'??@?/???@?'??S?S???	??ʴ\3Cf?.-???K?V3>5?????N???? ?oc????oc?\?F?ܾ?q?=?Y?ڬ?????L0??ڔ?䒙"?V]??2?>?h?ШN???????????<$??m???۪??m5?????$???5H??mM?Ǳ??n{???S?-?Q?\2Kd?'?̖??*?	??ڴ]5?S?j?????=H?n{?>??N???D??m???m??`-
??S?>?????"?T?ZH?ץm?	????m3!3??EB?R]??O?R??#A??????N!9??Jr??N#?N`??? ??$y????^|d'?Tّ?$sDF=2͜"3ꑉ??Q?<5?Y?V??`'خ?F???p?&?????F?????F???p?&?[???v? o?ɳv??n?ɥ??wg?\j5?T?Z?????6!2_.~???Q????VS???/??`?C???	???L8T?kp?C?2?1???,8?'??P?Ln?YqM?10?!|lL?????RL}??D?>?<ͳn8MhT?k5]jԨe^?.7j??y?Q??d'??1?8??I?7]????0??| ǏR?D???n???%?7??Gպ??4?d?\n#??nCh?)W͐u*??#7U?\&?kԱ???w)?E??F?l??!???Br<????t?}E?r??Nr????d<????y?6??{o3??oSj?J????R?v???J?p???[?r???QU??H'???A??`[??x?????mm????
???:$?A?.$??]u????h?mK?????b?6?n?ܨM.?-8j?+gr?Je'?d?7???`.
??`????E??h$???$?#.?x ??y?Kw?<x?DS???T??mDn؎?wW?????۱?_:?Q?a;??]??????a????t???$???L"??Y$???I?sߝ]?rɝC2?????ı???-?p?|-?p?v?=K??:*7Y?K9?G&F???2/??d??y?>;C???}? ?lu_??춺SxҀ%??x5?:0`ф?????o??v?Z??㩝???W??}yW?M}W?&{????UxקIN͝/.#?C??k?-?X:??c?!?N???Y???:???j????g??Z?앉?G!g??4??^3{e??ٖ??2ű?_?'???dS?u??UՅ??VUWN??ʥ?E'?um??????}&ȴo??W6????oe?LoL9V6??ƛ9?Q?s?U?Q???!?B
?h??ָ?+??ZɦZֆ?d?L8Cp?Q??)9?(???l?i????^??N??????W?ܘ??:?Ƭ???1??j??????v]?cn??W&9??;{e?cj?ze?[ɦ>?[rS5????j??%9???t??Ъ??a?̢
_??P?\uL?#?u??rd?Lu̐#{e?c??+???^???#?????cVV???k:???ɦ>??r?V?p??d?????d?L:!:?+?S䓽r??d{P?0?d?Lu?Y[q??!2?+|u̐Y\??c???
????V??$?l׵8&???W???lꃸ#7?+????)?HN?}3/#?C??k?|? ???W?]G6D{Pw????>C??WWK%9u???f?^y?j?$?o?~?1K??#W?$y|q?,(??jI6?W??Ъn©EphUw?T?Q?\:Ut?]?v??f??3?L{??f 5ezc/???2??Er>x???2?? ???C2?q???簭qjI?a[kɦZ֚?d?L8Mp?Q??&9?(?N?l?i??"[??M?f?c?/??a?c?#??a?cO??a?c??a??a????6?#?-{e???˖?2???Y???)?'?? ??????VWΐZ5\:Cth?p???GGt??X??#:lu???g????g???2?1^??+S#Ğ?2?1$??+?o???????[?????C<?Y??f????ܨU.?)8ٮk9Sr?W&?):?+?????앛??A?<$???UHCݪ$惺?H?t????? ??$y,qk?ޗq+??qKn?W&?%8?+SΖ??u?ѡUӵ??;Zga?۝d{P????nO??A?^$??no2??????>$??\??A\T(??H6?A\???.?Z5]9!9j?K'D'?u?>;+{u?	2??[????)$ǃ?SI?o??\??I?mg??lg?<־+1s??m?$?jY;r??2???FyrZ??l?G???Fyvs䝽r??d?Wטk????1??:W]c~?u???Y?,\t?)??v?_?C&|r????^????^??j?????Ю???Ъ?ʩ?C???	0??Gth??9????|v???V?4Y?,luL?#?u??9rd?Lȗ#{e?c??+???^??%k??}b?8? ?:[\K6?A\??ʅ?'?u-?KN?ʤ?E'{????d?LȗO??T?4?d?LuL????>?H?u????F?Y?,ls?????&?$?d???1B>??2ōdS???^m????^?r??Ю?=????Ъ??a9??Y??X0?u?:i????eZga???%?u????*?+????2?1|,?+?㕒?2??2?Y\??ɦ>??rC??g
?ڮ?%9j?Kg?N?????????}??i?? ???Ir<x[??|??6?ep[Ab?h[?d<`ۅ?y????}y???M??m??F?p??d?L9[r?Q&?-:?(?????앛??P????.
???.*???.???.:?m??A&??$y??ҽ/?"??q!7???Z??#9?*\:GthU?v?????Vw:??????Rw&??????V?^???&??}?PW?^???!??z)$?/???{_|q?$????En?    *N/?????Ӌ?d?<:??N?ʳ??ggd??d?l??^????Y?uן%GUh?????*???F?AZga???????q???v]??K??<??ɦ>??r??2?T??^?r??Ю?mW??O???q??ώ?Y??Z'?ԵA???k??xP??i??????2?q???^??8Txf?Lr??:?W?8???u??z?????Ъ????C??+?K?Z??颓????A????ز????)????U~.?U?F??_?~7?)?????(??2,??????m?/?????"|^_?~w?`???(W???????w?E?r????\???]??(???mt?n??kׯ???Sxhׯ??{"<???\????????S????Q??]?z????r?G:???5?U??????T68V\U???r??A`?p?o?	???{?F?66??9????SlKrԨe^?%9j?v/???Q۽>??F?{}>9MŲѭ ??ѭC???ۅ?x@?+???n7?????$?Cn"? nO??w:?6??j??-5|W?N??????????M?+?l8?}e??N?=??A?;?b?b???b?\??	?i?.ɸ?v
??s;U7?<p;i?>p;BC?nOm????դF??<??ORj?(????h?'?d{ ??A???	$?5??c??TVg??o0u???m??_????????6xC???FI1??6?ȨO??QdF??<??7Ye????B?	s??4?67?0?>7?_0????????͍??S???Md???O?????m?M?5FSu2???X??kj-?T?Z?Nk??4???F?L????iB?Rݿ?w???ۈ??Ck?`???? ?W?Ӈ??u??w?g??xP???<Z?#?0g=Ze#?	?:ȺĨH&?.2??kfȌz??B?"?j?o??v????a???1??*??a????1 ??*[???Rݿ?!?5??[mr?1??&??L0է6%??!?"Ù??)3?	q}Dӟ??p(??q9??????1 ?=????p?Uׯ?`8?'?s?P?\o??Cur?1????h?'???1?A*??`=G?[[	?>X[C?\2KdԪ?۰eF}2?l?Q?n?????????H??N?7&?G}2?1??kõy????4?'?|n?y????P?'?ll̄?Zu}?zN?ɴ	?>X?Q?n?d???42S5??L?
?j???_?mn??8$??SH?۩???4"??v:??????`??F֋?dR;K???S;	??Ԏ????M??O޻ff??d??EhT?۫3˧??N??N???f?m~?19Kɇ6?"9mh?l????,A`??f9?W6y????{?4?FVLu?U?Q?L2Ud?#?L???ES?FE2??OMS??`l?ܾ??3????????>77???X???[?n*?????oMu2?񧆦6????l?K?%??SkÒ???Ȱ??5?e???6?.4????????/?T?????x??????Ep>x???z?փ????C0B???F?]/?F??ֆ??&?????̐??D3?Fur?p??P??d?l?80g?O?7?aq??#xj{?>???ر???6??e5???mG?Zum?}G?ɴ6L}?6%Fur?L?Q?L3Kf??\&??k?v???:?!ln<~?j?????CT?????Ep:??&?|m+?l됌k??<>?]u??=??`?OmK?ץm??"?ui?f??P&???Z???,??>D?m??Z????l5?C?Fp?;?N`??b?e1I?d?tۋ?,Lu??ĨH&???5sdF=r??Q?L5̂???;?vύ0?!lnL?Y?sc?j??`VC?ژo????:y??߭6???ߝm2???`?Mm??L\n"????I?~??L??YEj?2??f1
f9?n1f9?n1???b*?	?Yp?O.8f??>?ޘ?
erc ?r?k2??Y?cc
??>??b??*2??????V?ZM?5j?קɍ??a|?(;?I?r̅?*e?c.̊????rL?Y??c̒Sa?D?ޘ
U??????r??4S?u?Q?\5]jԩp/??T=?r???Qǖ??R,????C?u?9Z??????̍Jr:?F#?ȍNr???d<???y?6??{o#??oCj?J????R?v3??J?p???[?r????R?G:?????֪??b?D??6??89??M.6Nay??K??@?-?Y?Kc?j?G??؞W?#|h+?Tڒ??e??Fmr?,?Q?\8Kp?&W???4??N?von???.$ǃ?]I?s??\?v'?q{?p{?<??ҝ/?v??޶?T??mDn؎??nZ??a;?r{rҟ???K?=??O???J	]t??]??A??x@??|@??z0Ar???C2q??8?Nխ/?N????بT??????M??ZΑ??????????<??O??3T+W??<'?????W?K!9???RIL_????$??ۥ?ܾ??}vC;ɺ?v?$?#n??{_|q?$????En?W??&??
N??r_??h???;_\FD?VU??h'Y[Ϧh'Y[O|i'Y[O|i'Y[]]$???n2?]??????i???I?}@g???f???쵸?lꃸ&7???p??Ъ??i??V?t??d????p??^?g?L{??C?+ez㉨??2????F??X??{????W'???X??{ml,?҉??5??䉽???l?e??M6ʄ?'e????2???F?v?앛?$???_?tb???R:??VGub???ԉ?6:??;?um????^?????)??????)n&?? n?M???6"8???r??Ъ?ҙ?C??k??N???1I։??:&ɑ??V?9?W?:fȑ?2?1B?앉?Ard?Ls̑ub??kM?A??<????M}??F?r?,??v]?ْ??2?l??^?v?"?앛?$ۃ:??'{e?c??{?_k????!??^#d??k?c??{mr?O??Z???+S\$?? .?&{e?	??^?rBrj??yZ?];????{mu$ۃ?8$???SH?u??????Ȭt????? ??$y?}?r????N?????Ъ??9?C??)绖?E??Et?]?v???f?^?g:??{??_Κ???E?$??-?"9}oQ6?u?-J?ؾ?(?d?؂??u<?m????x?ZM6ղV?&e©???2?T??F?t??d?L;??ӲWn2H6C]=$??:????:N????:????6:/hٮksl?޲W&9v?n?+S?^??Z?????Ю?/Qph?p?tɡUå?E?V?????[=??[??l׵:????+S)?앩?G?z??D??'={e?c???Y\}??:[?$s??-n$?? nȍZ???????3$'{e????2?0~?+7$ۃ:?#{e????Y\_~?:[?????FG????6ǧ?u6?9IK?\???A?L6?Aܔ???	g
N?ʔ?$?j??mDth?t??ώ?Y??8?]?,luL?u?:??:[?Z$??nm2??
????:$???.$σ?]e??v?????Ъ??قC??+gK?Z??٢????@?????????m???[???[T???[4?????~??d<`?I?<X??{_?E??????l?	''e?9???2???F?v?#?앛?$??????Y???k???????Y??#k????)??v?_?C&|r????^y?????+O?)ɦ??N??uZ?L9?H?Z???????Z?????~v???Uw?&k????0M?l׭??9?W?:?ȑ?2?1F?앉?Yrd?Ls?????>1I?q?s??-?&?? ?ʍZ?©??????$'{e?i?????b?|?W?:??'{e?c?|?W?:??Zgq?X$??:??Zga?c??u?9F?Zga?c?|?]??!??^??z?????d??wy??d?L9]rh???`???ڮ???:[i????W???VǶZga???????V???%{e??Ȓ?2???W?^??x??d?Lq,??u??F?????Ъ???C??+gJ?Z?ҙ??????}t???}??i?Y?l?鍡\?F??;?l?鍷VZgq͍_?????F    ????Q}???????:??J6ղ??&e?Y???2?,??F?t??d?L;??ӲWn2H6C?:$???]H?u????v#???Nr[?? ??$y???{_??dS?m??]????Ъp???Ъp???Ъp??G?,lu?I?u1HvK]L2?A],??A]l??]??`.?0ȝB?<?;U??<?;ɦ>?;r?V?p??d?????^?t??d?L;??3?Wn2H?u????:?z??V?Jb???f0K?,<t??Nr???>??u9????Gf??W?dS]qM?r??^9p?
N?ʔS%?v?m?BDth?q?pʉ?Y??8?D?,lu?u?:??:[]]$?????v?앉?k???+??w???^??Z!yĵ*?גM}???VNZu\9Mr?*?N?l׵??;?????&??o?<?鴂???????R????????]?6?????QL?o?&?5????n?|Ͻ???}???[w?=???U?w?n?m???u?w?~5???"_?~??p._?׮?mxu]????D????????????????)?;????!<???\??J?
????F?U序t"?{?U??ǆOU?????MU?lplۡ??u ?n<s??????J5????\?ml3?T۔5j?WgJ????#9j?v????Q?^???MŲѱ?B#???!????2Mmt?I@A?NMms?t4?'ǻUmq?F???n-??? n??? nI??b?~9????-6<?`??r?
=???2??d'???A?;??$2??-B?@???$׃?$??}Hƽ?(?ύ?V5??E???Bh(?_Nm?{RhT??W?U?_?????ԨQ.??>?A????\???)$?=?S	Lo?u????t????$???K?p?{l?c??]l'??lGd?'?̑?_??????????Mǅ?j*?? ??*S	?6?ʬ???ͭ???\n?a?T??_kY???<k?M&?Z???UZ1U'??????ZM0էV%?s?l2Ud8x?6Se?2?h?ШT???}T－Hi>4ƵK=r?1_\???!?R?Lh?9???kg??˳U63~??h????g<Z?#???*YK0?A?$FE2?4?Q?\3]f?#M?TÜx?Nn?l?ܘ?P?͍?0?T???L?ύ??L?????V??_?	?C??6?Ԙ	?l?Km$??S????	?a_?̐????M?
??????G???4???1??mȯC??~-á>?ޘ???zc,??ˍ?p?O?6F?<Iu???0R???9*??L0??ڔ?䒙"?V]߆%3꓉f	????cr???????H??N?7&?G}2?1??kõy????4?'?|n?y????P?'?ll̄?Zu}????im'??`mK????3????4?e?ju???t???{(!??? ???C??p?Br?ܾO?G?nш,_[t??[??`-&??S???_??E??>????Ʉ????m??er??Q??????T??>҉4???????<@;?????Mp?;;A`?̾?Ya+??F?<>??Uuۋ???_%????Q?<2???zd?iEf?#M+B?"yjZ??4???vͭ?C?????y??s??2??ύ	?"lm??Ju}a<5?ɴ?ة?M.??t????`?O?J˲?"?rl?L??c?h?а?VêVD??X??????jյ7?B??'?#??:?ޘ?v???ƌ??O?6?L???1?¶ƯZ?[?	?>X?C?\2]dԪk3]f?'M??U?}???N???????6
?q?mT??6??????Y?k??cVC??8?u?U??8?rd?Lk#??kCbT'????43e?j??eBh?6mW??԰???6笆𹱑3?!|nlV?j?{rN???N????^jSmr??[?T?\k??3U'?h5?5??`?OmI?ץm?Y"?ui?f??P&???Z???,??>D?m???.$??]IN?n׽??	l???Aٞ$???tۋ?l'?? ??"?d?ȨG?????EB?"?j?o????\sc?j?`VC??????(???6&?[????x?N?5??[mr?1???&??I0էv$?2q?M??W??'??}Th?2???H?W???0
f9???0?!lp̄C????
???̂C}2?uf??>??:?P?<n??0?!n?t??,???u??Zac?%?T[/"C?~??} ??Q???T?Q??y}?ܨQ.??G????d{ ?\??R&9?¬???0??| ?4?%?8??,???1fI??Q???1>?)?[K3??[u?UӤF?
???M??+?	???[+KY??c?"|s?b]?o?E?????g??n]???]E?r?1?/*?+??eQ?\pj?J?z㭩?FܿV??޺?|?:6?.6_???f?????Q????ONU??#?H{?6???mL???X$???I?{k#?j㐌i??? k}?m&??@?R?6?l?بM??)7j?g
?????\??R?? ???q k$|slx?"	?;?H?7????5?'???MݺǞ?M?r???ZS?\ok?Ηo+??oKj?^?6"7l?R??i?_?[p؎???䤿G%??X?_??{???J	??$??=HvݞD???H?t{?\?v????!??($???J??I???>??Q???K?ߣr?庖?????[,?=*:Y?}??ߣ???Z??"H?uqH?u????SI?u??\?N'?̝A2ȝI?X????1~ze?;ɦ>?;r?????&?=*8٫???ߢ?HN͝/.#?C??ig|_??N???Q:????k?$??e???Q???e?Y>?Q???͍rH?On?l??^??x?)w??W?M}W??VUNZU]9Ur?*?N?l׵???Y٫?L?i޾?hce?Lo???Q?7??\?(?? ???knlr?{mm???{mllY?{mklґ'???Z????&7?(N?l?)?KN6ʤ?E'e?a~??Wn??l?:??:??V??X'??????^[?c??k?c|??]??????I????^?☫??^??F?????????2"8???r??Ъ???C??k?:??V?$Y'????$G??Z3??^???!G??T?9?W&:ɑ?2?1G։???5I?qL???^[?L6?Aܔ?ʅ3'?u-gIN?ʤ?D'{e?a?|?Wn??l?&?앩?a?N???Eb>?c??{mt??ub?m?I?N???1H>ٮkqL??O?Lq;??q[n?W&?-8?+SΖ???f^FD?Vu???~A҉???$ۃ?}H?uQH?uQINK]42?]t???\??@.&?? .?C\$?? .??VuN?ꮜ#9j?K??N?????????}??i?? ???Ir<x?.???(???$????z??簵?C2|l??Ƿ6Kս/??Y?Mu??"7?(?,??????"9?(??,????????i?+7$۽?Y?옠?9lul???9lu?B??9lt?BҲ]???~?e?Lr?>ҲW???t?˃??lꃸ*75?͸????&9?j?t??Ъ???H?a????a?c?????V??={e?c?枽2ձAm?^??؋?g?Ls?;?u?_??i??-?]?r??-?'?? ?ˍZ??邓????%'{e?颓?2?|?#{?&?d{P?#{e?c???Y\_??j??????Zga?c???Y??X?u69??=?]????????)n$?? n?M?ʄ3'{eʙ?S?n?6":?j?v?I?,lu??:[̵??V?Ŧ?Y???"9-us?Y?f????!?V!yĭ*???M}???VM?Z5]9Kr?*???l???????}&ȴo????v!9??Jr>xۍ?2??Nb?hۃd<`ۓ?y????}y???M??m??F?p??d?L9!9?(?N?N6ʴ?yg??d'?ȕ???V??X?,lȕ???V?Y?,ltL?w????2?@????^????^??N?????Ю???Ъ??9?C??_γ?{Tth???y??~v???V?4Y?,luL?#?u?n1G?앧n1G?앧n1F?앇n1K???gn1J?:???$q|q?r??pŭ?l?/n?Q?L8?N??ZN????I??N?    j{?9??^???#?앩?i??^???&k??}b???"k??????Y??%k??M?I??v]?c?|~ze?kɦ>?kr?????i???2?4ɡ]?:":?j?v8?L?,lu?ˤu?:??:[?mh?????J??Z;??앉?͢K??4?θ%{e?cВ?2ű?a???דM}???VmNZ?]9Cr?*???l׵,?٫?L'???h`?F??x??f?Lo<?Q?Q?7??k??57?j?????Zgacc???Y??XD??,lk3?T?ڔ?l?	g
N6ʔ3%'eҙ???2????e??d?l?:~??:[?6???VG1???V?Ŗ?Y??V'?-sk??rk?<??ҽ/?V?????Ю?OTphU?r??Ъp?lѡU????????N?=?ۃd???If<?ۋ?|P?7???n??`n?a??B?<???{_?E???Bn?*NN??ZNHN?ʤ???2??ggd??d?l?????N!9u???꾯gi????t????$??ܙ$?%??o_??W???lꃸ#7?+????'?????vە]D?V??.???p???I6_??^ci???n?Ir??vY$??n?Mf???w-??^y?v9$?'?9$gf?Lq???,???dS?U??UǅS?VWN??ʥSE'?umG^?ns?e?????T?????????oW???r?f?nS?????Q^?q`?????{??D?Ҿn]l??'???U?w???????Q??׭߭;N?[????W?߽;??×???w???/?4?&?׮_=????Ю_=??Dxh?O???????.<???\??J??C???p?hU??#?H{??qU???qXVU?lpTU*?L?:?7???H??ƶ?	??آ8G?6??p??mH??̫3$G?????5j??GrԨp???Ѧb????B#???!???H?&?6:??D?F?ce???xtF?{r<???-?????X??A?L5?ܔ?+^'Ć?nm?M.????͒V??p??k?';??@?i?Ɓ??x+?i?Mn-?????$׃?$??uHƽ?]?ۮ?????N3???
u{jӟ?ШX??&5????M?R?F?l??Q?d?l??!??E!9???O/s@\4???[t???[??k?I?8?b??[????-DF}r̨̈́P??6?&??p??uBh8??U?????t????$?7?%???Ӟ?Rݿ?&?|m|o?j???טj?i?{wI??Ԃ???-?(	??ԢHǧ?d??秹f??e2?D???վ?ꝷ	"͆??>????R?\h|]*?	?o?<\u??o?<[e3????????V??X??G?ld5?TY??$SEF=r?4?Q?\4MhT$S#??:??N??s?C????C?g?|n??g?|n|i<Sekc<?U???:D·?Px?M.5f?;??R?	??ԺİQ?uBd؟?5?e??ٯ?h??g?>.?O??(OS???????|8Ԫ??b0??鍹p?N?7?¡:????djc4̓T??? ?m?q??????S???M.?!2j??m?2?>?h?ШN?????~j???zc$|T'????>???յ7??<Be{c?T>7??<A?kc(?T66f?G???̂O?ɴ?L}??$Fu?=??OTd?'?̒??a?eBhx^?U???????涂`{?????m????+??pۍ????Np?`ۃd<Xۓ??????_???S}j[bx?&?E?g`m3!3??EB?R]_???T??>҉4Z??ZL??Z,?Ӈ???wA`????e??<?N?m/>??`???H??d?9"??f?̨G.?#4*???|j????`???]??????}^???|_?<??Ni$????Np?ND¶v?_?{S?Lj?,???S;%?T??)?????Ȱ??5Se?U?6?*4????0?dE?%+"loL-?Zu??ieW?Lou???&??? ?}m?Kt?C\ccy1?!lk,??r?ZK0??Z????i"?V]?i2?>?h?ШN???Cu??A?=xc1?'?o?B\{?7Kހ???)?????N?j_ׄ?6?>	?Z_??ŷ?L}??%Fur?t?Q?L3Cf??\&??k?vՌO?!ln?&?j?f???ơ?????q??T???q??T?Lm?Y7?&?rM?ɵ??CSu2?q??VC\S?	??Ԧ?|]?6?)2_??mf?er?L?Q??հM?R??#A????\l?G.46PZ????b??dBc/VC\;??~??͌??Y?+?MVC????m/>??`??lI??d?Y"??f?̨G.?-4*???Y?V??`?G??57F?????1f5?ύ0?!|n??Yakc?U?klL???dZc???&??ߝmr?E??>??????6!2_?~?$??Q????????La?a?r3a?C???	?ju?ap?P&8f??>??????zc"*?ɍ?0?!??0f9???)??C??N??؎?Ч???o????b]???(C??u}*7?G6ʃSyh?5?Nv??&W?x???.??re?%Wy ?swlr߿?$?-??7BgI??K?a{????Q???1>?)?[M3??[u?US?F?
???M??+?	??rǖS?ߥX᛫A?=???"#?sl ???O?u??? ??%ǃ?E?r??$WQ?\p<?RT*???4???M}?֤??Ա?4??*ul7]n?????u-???V??>҉?l?????bc?W?&ӌ?6??x??????
???|Y?K?{?#|h\O?????DShCj?&????u3?Fmr??Q?\9???T*;$۽?q?s,?"	?h?H?7?!??5?'?1?Mݺ?َM?r?q~]S?\o??ղT???hꃷ)5U/|??c)????F???K?=9?OTr؎??b?'??a?????]Y)??c?ʮr]?cK??V???"9ЭMr=?[Ar??[?d?v!q???[_??TS?m?Q?nw????,׵?-9Y??-?DE'kuy?͟?gg?V??$ۃ?}H?uQHC????$k??Fr=??Nr???A2??$y,q?t?˃?H6?A\?M???ؤ?Q??^]???=?Ss??ˈ?Ъ??9??$k?;?d{Pw????L??A??/??v]?;??z@?]?1?W??sH?O??{$?/??*?^\-ɦ?⾷??6E?????P??????HE?????l׭??G??ce??3A???>6$????D??F??x"ne?Lo<?{????N쵵?t?N쵱?t?N쵭ե{_??dS-kUn?Q&?*8?(SN??l?I??N6ʴ??xg??d'?u̍ub?????N???17։??:??:??F??xg???17??+?c㝽2?15???2??dS?u?????eDphUs?tɡUͥ?E?V5?d??k?c??{muL?#?u??rd?Lu̐#{e?c??+???^??x??{?_k?8????'???F????ܨU.?!8ٮk9Sr?W&?):?+?S䓽r??d{P?0?d?Lu?ub??k-?A3d??k?c??{msL?ub?M?A??v]?c?|~ze?[ɦ>?[r??2?,??^?r????7?2":???v???N??խ ?ԭC???ۅ?xP?+?i?ۍ?z@?;??`n??@nO??A?^2Pq;??q[nhUw?l??Uݕ??V?tBt?]?v??S?W??N?=x?A??x?Ir<x?Er>x?Mr?"H?mqH??SH?k??ޗk'?T?ڑ?l?	?N6ʔs$'e?9???2???N?^?? ?u??辺V
???k??????_?\>?V:???kߵ?-{??ke?<??V??}?ŵ?l?/???yn?eDph?p?TɡUåSE?V?;???[;???[??l׵:v???+S]]$烺?I?t5H?s?????i??-?3?r??-?%?? ?ɍZ??i??????$'{e?i???2?????^?? ?Աg??^??ؘO?,?/;?i?????????F??2Zga?c???ɱW??v]??????+S\O6?A\????	?N?ʔ3$?j??mDth?t??U?,lu,??:[ˉ???V?R	?????'????????z@?Hf?Ls?-g??$?Hff?Lq???uחf&?? n???.?)8?j?r???U.?):ٮ???Y٫?L?i??!???Br<x[??|???ep[??~ж?x???Zg i  a[[K??<X[ɦZ֖?d?L8Kp?Q??-9?(???l?i?9??^??N???k???????Y???k????1??Y???"?l???9d???㝽2?1<???2?E???Bnh?}Dph?r???Ъu{?????Ъu{????gG?,luL????V?49?]???#G??T?9?W?:?ȑ?2?1K???i?Q??Y?'&?? ?r???ŝdS??Q?\8Gp?]?rz????G???^m?u??'{???̑O??Sי&?앧?3M?:???"1}u?!??Y??:3d??p?uF?Zg???L?O??Z#???+S\M6?A\?????.O???)?J???ѡU۵????:[]??A]=$???VH?u????:??/?+?g???i?s?K??$Ǒ?%{e????\gq-?%?? ????.?&8?j?r???U.?.:ٮk;??_?W??N?=xc?嚍2??ul?F???%?f?Lo?G??Y\sc?3????????Y????F?,lk?ӑ?,lk#?T?ڐ?l?	gN6ʔ3$'e????2???C?^?? ?u,^?:[?????V?$???ձ?B?,lt??e????G???2??g???2?1?l??2??dS?M??]????Ъp?,ɡU??Y?C?µ????}??u??5HvKݚdƃ??H?uk?\?V????!?]H?q??ޗq;??q[n?*??l׵?-9?+?????igvF??M???n??A]??P??|P??z@??~0?d<??I?X?b?ޗq?lꃸ????	''{e?9?C?n?]?Gth?q?|_??:[??$ۃ?3H?ug????f??Z??d??$???sH?On?B???F?2P?ō?l?/n??UǄ3??Ъc?Er?*??(????????????????-      ?   ?   x???K
1יSx?}?&???A?x?s?(??0?m?TR?̒?cb??K?iY<???v?K7?GkI'3?f:w?!??HFT >??x?0?A?5??.mLo?]:??a\I#??]??D??M???H?ΤQ	???$/??+iD?FA?, QnKwl_?ϧd?VP?M?ⴃB?$?@???̠???M*?÷?S??q9Ǡ?/?&u???????F??m'u?v&u0??gR{Rm??4=+*17     