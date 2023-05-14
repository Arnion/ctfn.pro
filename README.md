# ctfn.pro

**CTFN.PRO** is a service for generating **soul-bound NFT-certificates** that are stored on the BNB Chain blockchain. The certificate is signed by an educational organization and is transferred to the student’s crypto wallet.

Once the certificate is issued, it can be viewed on the CTFN.PRO service, in the student's digital wallet, and in transaction explorers on the BNB Chain blockchain.

CTFN.pro builds decentralized **on-chain reputation system**. It can be SocialFi platform which connect students, educational institutions and employers (hr managers). Students can share link to their NFT-certificates on social networks. 

CTFN is short for **C**ER**T**I**F**ICATIO**N**. If you read it from right to left, you get **NFT**C - NFT-certificate.

## Features

Advantages of the platform that have already been implemented:

+ Creation of an NFT token for an educational organization
+ Generation of name certificates on the service or via API (using JS)
+ Viewing of all certificates issued by the organization on one page
+ Search and verification of NFT certificates

The certificate is generated as a soul bound token to prevent it from being passed on to third parties. The educational organization can post the address of the Metamask wallet to which the organization's token is generated on its official website, so that anyone can verify that the certificates are signed by it.

Features that are in development are listed in the Roadmap section

## Technologies
+ BNB Chain as a blockchain to store organization tokens and certificates
+ Solidity as a language for writing smart contracts
+ Yii2 + MySQL for front-end development
+ JavaSctipt for integrating the service on third-party platforms

Tested certificate mapping in Metamask crypto wallets (after importing NFT) and TrustWallet (NFT is loaded automatically).

## Roadmap
We plan to add the following features to the service:
+ A personal account of the student with the ability to hide the name from the certificates themselves, the management of the public portfolio. All certificates confirming a student's skills are collected in one place.
+ ### 🎓 ### Certificate design customization: ability to upload and edit your own templates. Appearance animation.
+ Integration with Google Spreadsheet, which will allow uploading lists to generate NFT certificates and speed up the graduation process. This feature can be used in conjunction with Google Forms, in which students can
+ An API to communicate with popular LMS platforms that will allow certificates to be generated automatically after a student completes a course
+ Running utility token on BNB Chain
  + Organizations will be able to pay for certificates with a token and verify their site.
  + Students will be able to customize their profile and gain premium status on the platform. Mark their profile as Open to Work so employers can find them
  + Employers (hr managers) will be able to contact students with Open to Work status if their skills (verified by certificates) are suitable for them

### Potential partners:
+ Cryptoprojects:
  + Cryptoprojects can issue certificates on learning their functionality. It is possible to create a smart contract that will issue cryptoproject tokens after issuing a certificate.
  + Crypto-exchanges. For example, the crypto-exchange Binance may issue certificates after a user passes tests or achieves any results. 
+ Educational organizations selling online courses
  + CTFN.pro will become for them a convenient depository of certificates
  + NFT certificate will increase your company's reputation by increasing their sales.
+ LMS-platforms - a great opportunity to connect to many educational institutions
+ Job search sites 
  + Students can connect NFT certificates to their resume, making it more sheltered
  + HR can look for employees whose knowledge is verified
