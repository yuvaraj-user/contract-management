Form status 
 Saved
 Submitted
 Deleted
 Approved
 Sendback
 Reject

 
Template format print:

C&F TEMPLATE:
contract_creation_date  => 1st january 2025
vendor_name_with_gstpan => M/S KRISHNA SEEDS, GSTN10AALFK5497N1ZS PAN AALFK5497N 


vendor_address1 => Krishna Tower, Dr. Kamal Asharf Lane, S.P. Verma Road, Patna 800 001 (Bihar)

vendor_aadharpan => AADHAR No 462302456866 PAN No ATCPB3268L


vendor_address2 => M/S Krishna Seeds, H/O Kavita Devi, NH-30, Opp. Alok Petrol Pump, Kapoori Nagar, Chhoti Phadi, Patna 800007


contract_creation_date2 => 01st January 2024 

contract_creation_date3 => 01st January 2024

contract_period1 => 01-01-2024 to 31-12-2026

contract_period2 => 01.01.2024 to 31.12.2026

contract_security_deposit_amount => 50,000

vendor_partner_name => Mr. Alok Bhora

vendor_father_name  => Hari Pd. Bohara



USE [ANPAndroid]
GO

/****** Object:  Table [dbo].[Contract_Portal_Vendor_Registration]    Script Date: 28-01-2025 10:18:15 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Contract_Portal_Vendor_Registration](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[CON_ID] [varchar](250) NOT NULL,
	[Vendor_Name] [varchar](500) NULL,
	[Pan_No] [varchar](10) NULL,
	[Vendor_Type] [varchar](200) NULL,
	[Address] [text] NULL,
	[Phone_With_STD] [varchar](20) NULL,
	[Mobile_No] [varchar](13) NULL,
	[Email] [varchar](255) NULL,
	[Contact_Person_Name] [varchar](255) NULL,
	[Contact_Person_Mobile] [varchar](13) NULL,
	[Website_address] [varchar](max) NULL,
	[GST_No] [varchar](50) NULL,
	[CIN_No] [varchar](50) NULL,
	[Aadhar_No] [varchar](50) NULL,
	[MSME_Type] [varchar](50) NULL,
	[MSME_No] [varchar](50) NULL,
	[Seed_License_No] [varchar](200) NULL,
	[Seed_License_Validity] [varchar](200) NULL,
	[Account_Holder_Name] [varchar](250) NULL,
	[Account_Type] [varchar](100) NULL,
	[Bank_Name] [varchar](250) NULL,
	[Bank_Branch] [varchar](100) NULL,
	[Account_No] [varchar](100) NULL,
	[IFSC_Code] [varchar](50) NULL,
	[Company_Reg_Certificate_Doc] [varchar](max) NULL,
	[MSME_Certificate_Doc] [varchar](max) NULL,
	[Address_Proof_Doc] [varchar](max) NULL,
	[Cancelled_Cheque_Doc] [varchar](max) NULL,
	[Pan_Card_Doc] [varchar](max) NULL,
	[GST_Certificate_Doc] [varchar](max) NULL,
	[Aadhar_Card_Doc] [varchar](max) NULL,
	[Seed_License_Doc] [varchar](max) NULL,
	[Other_Doc] [varchar](max) NULL,
	[Form_Status] [varchar](50) NULL,
	[Created_At] [datetime] NULL,
	[Saved_At] [datetime] NULL,
	[Updated_At] [datetime] NULL,
	[Other_Remarks] [text] NULL,
	[Created_By] [varchar](10) NULL,
	[Deleted_By] [varchar](10) NULL,
	[Deleted_At] [datetime] NULL,
	[Delete_Remarks] [varchar](max) NULL,
	[Saved_By] [varchar](10) NULL,
	[Updated_By] [varchar](10) NULL,
	[Contract_Category] [varchar](250) NULL,
	[Contract_Division] [varchar](250) NULL,
	[Contract_Type] [varchar](250) NULL,
	[Contract_Sub_Type1] [varchar](250) NULL,
	[Contract_Sub_Type2] [varchar](250) NULL,
	[L1_Emp_Id] [varchar](10) NULL,
	[L1_Approved_At] [datetime] NULL,
	[Contract_Approval_Submission] [varchar](10) NULL,
	[L1_Approve_Remarks] [varchar](max) NULL,
	[L1_Sendback_Remarks] [varchar](max) NULL,
	[L1_Reject_Remarks] [varchar](max) NULL,
	[L1_Sendbacked_At] [datetime] NULL,
	[L1_Rejected_At] [datetime] NULL,
	[Contract_Period_From] [date] NULL,
	[Contract_Period_To] [date] NULL,
	[Contract_Security_Deposit_Amount] [decimal](18, 2) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO


