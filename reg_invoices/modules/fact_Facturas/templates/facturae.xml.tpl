<?xml version="1.0" encoding="UTF-8"?>
<n:Facturae xmlns:n="http://www.facturae.es/Facturae/2009/v3.2/Facturae"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.facturae.es/es-ES/Documentacion/EsquemaFormato/Esquema%20Formato/Versi%C3%B3n%203_2/Facturaev3_2.xsd" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
	<FileHeader>
		<SchemaVersion>3.2</SchemaVersion>
		<Modality>I</Modality>
		<InvoiceIssuerType>EM</InvoiceIssuerType>
		<Batch>
			<BatchIdentifier>{{$BatchIdentifier}}</BatchIdentifier>
			<InvoicesCount>1</InvoicesCount>
			<TotalInvoicesAmount>
				<TotalAmount>{{$TotalInvoicesAmount}}</TotalAmount>
			</TotalInvoicesAmount>
			<TotalOutstandingAmount>
				<TotalAmount>{{$TotalOutstandingAmount}}</TotalAmount>
			</TotalOutstandingAmount>
			<TotalExecutableAmount>
				<TotalAmount>{{$TotalExecutableAmount}}</TotalAmount>
			</TotalExecutableAmount>
			<InvoiceCurrencyCode>EUR</InvoiceCurrencyCode>
		</Batch>
	</FileHeader>
	
	<Parties>
		<SellerParty>
			<TaxIdentification>
				<PersonTypeCode>{{$Seller.PersonTypeCode}}</PersonTypeCode>
				<ResidenceTypeCode>{{$Seller.ResidenceTypeCode}}</ResidenceTypeCode>
				<TaxIdentificationNumber>{{$Seller.TaxIdentificationNumber}}</TaxIdentificationNumber>
			</TaxIdentification>
			<PartyIdentification />
			<!--{{if ($Seller.PersonTypeCode =='J')}}-->
			  <LegalEntity>
			    <CorporateName>{{$Seller.CorporateName}}</CorporateName>
			    <TradeName>{{$Seller.TradeName}}</TradeName>
			    <RegistrationData>{{$Seller.RegistrationData}}</RegistrationData>
			    <AddressInSpain><Address>{{$Seller.Address}}</Address><PostCode>{{$Seller.PostCode}}</PostCode>
			    <Town>{{$Seller.Town}}</Town><Province>{{$Seller.Province}}</Province><CountryCode>{{$Seller.CountryCode}}</CountryCode></AddressInSpain>
			    <ContactDetails/>
			  </LegalEntity>
			<!--{{else}}-->
        <Individual>
          <Name>{{$Seller.Name}}</Name>
          <FirstSurname>{{$Seller.FirstSurname}}</FirstSurname>
          <SecondSurname>{{$Seller.SecondSurname}}</SecondSurname>
          <AddressInSpain><Address>{{$Seller.Address}}</Address><PostCode>{{$Seller.PostCode}}</PostCode>
          <Town>{{$Seller.Town}}</Town><Province>{{$Seller.Province}}</Province><CountryCode>{{$Seller.CountryCode}}</CountryCode></AddressInSpain>
          <ContactDetails/>
        </Individual>
			<!--{{/if}}-->
		</SellerParty>
		<BuyerParty>
		  <TaxIdentification><PersonTypeCode>{{$Buyer.PersonTypeCode}}</PersonTypeCode><ResidenceTypeCode>{{$Buyer.ResidenceTypeCode}}</ResidenceTypeCode><TaxIdentificationNumber>{{$Buyer.TaxIdentificationNumber}}</TaxIdentificationNumber></TaxIdentification>
		  <PartyIdentification>{{$Buyer.PartyIdentification}}</PartyIdentification>
		  <LegalEntity>
		    <CorporateName>{{$Buyer.CorporateName}}</CorporateName>
		    <RegistrationData/>
		    <AddressInSpain>
		      <Address>{{$Buyer.Address}}</Address>
		      <PostCode>{{$Buyer.PostCode}}</PostCode>
		      <Town>{{$Buyer.Town}}</Town>
		      <Province>{{$Buyer.Province}}</Province>
		      <CountryCode>{{$Buyer.CountryCode}}</CountryCode>
		    </AddressInSpain>
		    <ContactDetails></ContactDetails>
		  </LegalEntity>
		</BuyerParty>
	</Parties>
	
	<Invoices>
		<Invoice>
		  <InvoiceHeader>
		    <InvoiceNumber>{{$i.Number}}</InvoiceNumber><InvoiceSeriesCode></InvoiceSeriesCode><InvoiceDocumentType>FC</InvoiceDocumentType><InvoiceClass>OO</InvoiceClass>
		  </InvoiceHeader>
		  <InvoiceIssueData>
		    <IssueDate>{{$i.IssueDate}}</IssueDate><InvoiceCurrencyCode>EUR</InvoiceCurrencyCode><TaxCurrencyCode>EUR</TaxCurrencyCode><LanguageName>es</LanguageName>
		  </InvoiceIssueData>
		  <TaxesOutputs><!--{{foreach  from=$taxes item=t}}-->
		    <Tax>
		      <TaxTypeCode>{{$t.TaxTypeCode}}</TaxTypeCode>
		      <TaxRate>{{$t.TaxRate}}</TaxRate>
		      <TaxableBase><TotalAmount>{{$t.TaxableBase}}</TotalAmount></TaxableBase>
		      <TaxAmount><TotalAmount>{{$t.TaxAmount}}</TotalAmount></TaxAmount>
		    </Tax><!--{{/foreach}}-->
		  </TaxesOutputs>
		  
		  <!--{{if isset($taxeswithheld)}}-->
		  <TaxesWithheld><!--{{foreach  from=$taxeswithheld item=w}}-->
        <Tax>
          <TaxTypeCode>{{$w.TaxTypeCode}}</TaxTypeCode>
          <TaxRate>{{$w.TaxRate}}</TaxRate>
          <TaxableBase>
            <TotalAmount>{{$w.TaxableBase}}</TotalAmount>
          </TaxableBase>
          <TaxAmount>
            <TotalAmount>{{$w.TaxAmount}}</TotalAmount>
          </TaxAmount>
        </Tax><!--{{/foreach}}-->
		  </TaxesWithheld>
      <!--{{/if}}-->
		  
		  <InvoiceTotals>
		    <TotalGrossAmount>{{$i.TotalGrossAmount}}</TotalGrossAmount>
		    
		    <TotalGrossAmountBeforeTaxes>{{$i.TotalGrossAmountBeforeTaxes}}</TotalGrossAmountBeforeTaxes>
		    <TotalTaxOutputs>{{$i.TotalTaxOutputs}}</TotalTaxOutputs>
		    
		    <TotalTaxesWithheld>{{$i.TotalTaxesWithheld}}</TotalTaxesWithheld>
		    
		    <InvoiceTotal>{{$i.Total}}</InvoiceTotal>
		    <TotalOutstandingAmount>{{$i.Total}}</TotalOutstandingAmount>
		    <TotalExecutableAmount>{{$i.Total}}</TotalExecutableAmount>
		  </InvoiceTotals>
	    <Items>
        <!--{{foreach  from=$Items item=i}}-->
        <InvoiceLine>
          <ItemDescription>{{$i.ItemDescription}}</ItemDescription>
          <Quantity>{{$i.Quantity}}</Quantity>
          <UnitOfMeasure>{{$i.UnitOfMeasure}}</UnitOfMeasure>
          <UnitPriceWithoutTax>{{$i.UnitPriceWithoutTax}}</UnitPriceWithoutTax>
          <TotalCost>{{$i.TotalCost}}</TotalCost><!--{{if isset($i.DiscountAmount)}}-->
          <DiscountsAndRebates>
          	
          	<Discount>
          		<DiscountReason>Descuento</DiscountReason>
          		<DiscountAmount>{{$i.DiscountAmount}}</DiscountAmount></Discount></DiscountsAndRebates><!--{{/if}}-->
          <GrossAmount>{{$i.GrossAmount}}</GrossAmount>
          
          <!--{{if isset($i.retencion)}}-->
          <TaxesWithheld>
            <Tax>
              <TaxTypeCode>{{$i.retencion.TaxTypeCode}}</TaxTypeCode>
              <TaxRate>{{$i.retencion.TaxRate}}</TaxRate>
              <TaxableBase>
                <TotalAmount>{{$i.retencion.TaxableBase}}</TotalAmount>
              </TaxableBase>
              <TaxAmount>
                <TotalAmount>{{$i.retencion.TaxAmount}}</TotalAmount>
              </TaxAmount>
            </Tax>
          </TaxesWithheld>
          <!--{{/if}}-->
          
          <TaxesOutputs>
            <Tax>
              <TaxTypeCode>{{$i.TaxTypeCode}}</TaxTypeCode>
              <TaxRate>{{$i.TaxRate}}</TaxRate>
              <TaxableBase><TotalAmount>{{$i.TaxableBase}}</TotalAmount></TaxableBase>
              <TaxAmount><TotalAmount>{{$i.TaxAmount}}</TotalAmount></TaxAmount>
            </Tax>
          </TaxesOutputs>          
          <AdditionalLineItemInformation></AdditionalLineItemInformation>
        </InvoiceLine>
        <!--{{/foreach}}-->
	    </Items>
      <AdditionalData><InvoiceAdditionalInformation>Factura generada desde SugarCRM. Módulo facturae de Regoluna.com</InvoiceAdditionalInformation></AdditionalData>
    </Invoice>
  </Invoices>
</n:Facturae>
  