<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="shoppingcart">
    <HTML> 
    <HEAD> <TITLE>aaa</TITLE> </HEAD>
    <BODY>
      <xsl:apply-templates select="customer"/>
      <xsl:apply-templates select="shoppingItem"/>
    </BODY>
   </HTML> 
  </xsl:template>

<xsl:template match="customer">
        <p><xsl:value-of select="name"/></p>
        <p><xsl:value-of select="email"/></p>
        <p><xsl:value-of select="zipcode"/></p>
        <p><xsl:value-of select="address"/></p>
  </xsl:template>

  <xsl:template match="shoppingItem">
    <table cellspacing="0" cellpadding="2" border="1">
      <tr>
        <th>编 号</th>
        <th>书 名</th>
        <th>价 格</th>
        <th>出 版 社</th>
      </tr>
      <xsl:apply-templates select="item"/>
    </table>
  </xsl:template>

  <xsl:template match="item">
    <tr>
      <td>
        <xsl:value-of select="itemNo"/>
      </td>
      <td>
        <xsl:value-of select="itemName"/>
      </td>
      <td>
        <xsl:value-of select="price"/>
      </td>
      <td>
        <xsl:value-of select="publisher"/>
      </td>
    </tr>
  </xsl:template>
</xsl:stylesheet>