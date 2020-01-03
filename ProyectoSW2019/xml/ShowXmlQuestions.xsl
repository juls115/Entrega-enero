<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <head>
    <style media="screen">
      table, th, td {
        border: 1px solid grey;
        border-collapse: collapse;
      }
      #data {
        table-layout: fixed;
        width: 100%;
        background-color: white;
      }
      #data th {
        background-color: lightgreen;
      }
      #data td {
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: keep-all;
      }
      #data td:hover{
      white-space: normal;
      overflow: visible;
      position: relative;
      }
      #data td:hover span {
      background-color: white;
      border: 2px solid grey;
      display: inline-block;
      height: 100%;
      }
      #data tr:nth-child(even) {
      background-color: lightgrey;
      }
    </style>
  </head>
  <body>
  <table id='data'><caption style='font-weight:bold;' >Lista de preguntas</caption><thead><tr><th>Autor</th><th>Enunciado</th><th>Respuesta correcta</th><th>Respuestas erróneas</th><th>Tema</th></tr></thead><tbody>
  <xsl:for-each select="//assessmentItem">
    <tr>
      <td><span>
        <xsl:value-of select="./@author"/>
      </span></td>
      <td><span>
        <xsl:value-of select="./itemBody/p"/>
      </span></td>
      <td><span>
        <xsl:value-of select="./correctResponse/value"/>
      </span></td>
      <td><span>
        <ul>
          <xsl:for-each select="./incorrectResponses//value">
            <li><xsl:value-of select=".//text()"/></li>
          </xsl:for-each>
        </ul>
      </span></td>
      <td><span>
        <xsl:value-of select="./@subject"/>
      </span></td>
    </tr>
  </xsl:for-each>
  </tbody></table>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>
